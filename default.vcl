# Goes in /etc/varnish/default.vcl

vcl 4.0;

backend default {
	.host = "127.0.0.1";
	.port = "8080";
}

sub vcl_recv {
	# Happens before we check if we have this in cache already.
	#
	# Typically you clean up the request here, removing cookies you don't need,
	# rewriting the request, etc.

	# Can't have the REVEL_FLASH cookie as it stops
	# Varnish from caching the response
	# if (req.url ~ "^/") {
	# 	unset req.http.cookie;
	# }
}


sub vcl_deliver {
}

sub vcl_backend_response {
	# Happens after we have read the response headers from the backend.
	#
	# Here you clean the response headers, removing silly Set-Cookie headers
	# and other mistakes your backend does.

	# Can't have the REVEL_FLASH cookie as it stops
	# Varnish from caching the response

	if (bereq.url ~ "^/") {
		unset beresp.http.set-cookie;
	}

	# Set TTL to 20 seconds
	set beresp.ttl = 20s;
}
