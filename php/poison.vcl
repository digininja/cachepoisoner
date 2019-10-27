#
# This is an example VCL file for Varnish.
#
# It does not do anything by default, delegating control to the
# builtin VCL. The builtin VCL is called when there is no explicit
# return statement.
#
# See the VCL chapters in the Users Guide at https://www.varnish-cache.org/docs/
# and https://www.varnish-cache.org/trac/wiki/VCLExamples for more examples.

# Marker to tell the VCL compiler that this VCL has been adapted to the
# new 4.0 format.
vcl 4.0;

# Default backend definition. Set this to point to your content server.
backend default {
	.host = "127.0.0.1";
	.port = "81";
}

sub vcl_recv {
	# Happens before we check if we have this in cache already.
	#
	# Typically you clean up the request here, removing cookies you don't need,
	# rewriting the request, etc.
	
	unset req.http.Cache-Control;
	unset req.http.Cookie;
}

sub vcl_deliver {
	# Happens when we have all the pieces we need, and are about to send the
	# response to the client.
	#
	# You can do accounting or modifying the final object here.
	if (req.url ~ "/age.php.*$") {
		unset resp.http.Age;
		set resp.http.X-Powered-By = "Curiosity";
	}
	if (req.http.User-Agent ~ "Android") {
		set resp.http.X-Powered-By = "UA hit";
	}
}

sub vcl_backend_response {
	# Happens after we have read the response headers from the backend.
	#
	# Here you clean the response headers, removing silly Set-Cookie headers
	# and other mistakes your backend does.

	if (beresp.ttl <= 0s ||
		beresp.http.Set-Cookie ||
		beresp.http.X-No-Cache ||
		beresp.http.Vary == "*") {
		/*
		 * Mark as not cacheable for the next 10 seconds
	 	 */
		set beresp.ttl = 10 s;
		set beresp.uncacheable = true;
		return (deliver);
	}
	set beresp.ttl = 20 s;
	return (deliver);
}
