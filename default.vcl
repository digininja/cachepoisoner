# Goes in /etc/varnish/default.vcl

vcl 4.0;

backend default {
    .host = "127.0.0.1";
    .port = "8080";
}

sub vcl_recv {
}

sub vcl_backend_response {

	set beresp.ttl = 30s;
}

sub vcl_deliver {
}
