# Marker to tell the VCL compiler that this VCL has been adapted to the
# new 4.0 format.
vcl 4.0;

# Useful docs
# https://book.varnish-software.com/4.0/chapters/VCL_Subroutines.html

# Default backend definition. Set this to point to your content server.
backend default {
	.host = "127.0.0.1";
	.port = "83";
}

backend secret {
	.host = "secret.digi.ninja";
	.port = "80";
}

backend digininja {
	.host = "127.0.0.1";
	.port = "7777";
	# HTTPS as a backend
	# https://stackoverflow.com/questions/16840673/using-varnish-with-saas-https-backend-servers
}

sub vcl_hash {
	if (req.url ~ "^/routing.php") {
		hash_data(req.http.x-host);
	} else {
		hash_data(req.url);
		if (req.http.host) {
			hash_data(req.http.host);
		} else {
			hash_data(server.ip);
		}
	}
	return (lookup);
}

sub device_detect {
	# A custom function to generalise a UA down to Chrome or other
	set req.http.X-UA-Browser = "other";
	if (req.http.User-Agent ~ "(?i)chrome") {
		set req.http.X-UA-Browser = "chrome";
	}
}

sub vcl_recv {
	# Happens before we check if we have this in cache already.
	#
	# Typically you clean up the request here, removing cookies you don't need,
	# rewriting the request, etc.
	
	unset req.http.Cache-Control;
	unset req.http.Cookie;

	if (req.url ~ "^/routing.php") {
		set req.http.x-host = req.http.host;

		if (req.http.X-forwarded-host ~ "^secret.digi.ninja") {
			set req.http.host = "secret.digi.ninja";
			set req.backend_hint = secret;
			set req.url = "/";
		}
		if (req.http.X-forwarded-host ~ "^digi.ninja") {
			set req.http.host = "digi.ninja";
			set req.backend_hint = digininja;
			set req.url = "/routing.php";
		}
	}

	if (req.url ~ "^/redirect.php") {
		# Call a function
		call device_detect;
	}
}

sub vcl_deliver {
	# Happens when we have all the pieces we need, and are about to send the
	# response to the client.
	#
	# You can do accounting or modifying the final object here.
	if (req.url ~ "/timing.php.*$") {
		unset resp.http.Age;
		set resp.http.X-Powered-By = "Curiosity";
	}
	if (req.http.User-Agent ~ "Android") {
		set resp.http.X-Powered-By = "UA hit";
	}
}

sub vcl_backend_fetch {
}

sub vcl_backend_response {
	# Happens after we have read the response headers from the backend.
	#
	# Here you clean the response headers, removing silly Set-Cookie headers
	# and other mistakes your backend does.
	#

	# would be good to add a url check for just the redirect page here
	if (beresp.http.status == "302") {
		set beresp.http.status = 720;
	}

#	if (beresp.ttl <= 0s ||
##		beresp.http.Set-Cookie ||
#		beresp.http.X-No-Cache ||
#		beresp.http.Vary == "*") {
#		/*
#		 * Mark as not cacheable for the next 10 seconds
#	 	 */
#		set beresp.ttl = 10 s;
#		set beresp.uncacheable = true;
#		return (deliver);
#	}
	if (bereq.url ~ "/timing.php") {
		set beresp.ttl = 16 s;
	} else {
		set beresp.ttl = 30 s;
	}
	unset beresp.http.Set-Cookie;
	return (deliver);
}
