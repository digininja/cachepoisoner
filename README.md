# Cache Poisoner

A lab to play with web cache poisoning

## Varnish

Edit `/etc/systemd/system/varnish.service` or `/etc/systemd/system/multi-user.target.wants/varnish.service` and change the `ExecStart` line to this:

```
ExecStart=/usr/sbin/varnishd -j unix,user=vcache -F -a :81 -T localhost:6082 -f /etc/varnish/default.vcl -S /etc/varnish/secret -s malloc,256m
```

`-a` says to listen on the host:port specified
`-T` is the management interface - keep this to localhost or set it to `none` to disable it.

After changing the service file, you need to reload it:

```
systemctl daemon-reload
```

Then edit `/etc/varnish/default.vcl` and add the following:

```
vcl 4.0;

backend default {
    .host = "127.0.0.1";
    .port = "9090";
}

sub vcl_recv {
}

sub vcl_backend_response {
	# The default TTL
	set beresp.ttl = 30s;
}

sub vcl_deliver {
}
```

## Apache
The following entry in the Apache config will enable the proxy pass through to Varnish running on localhost:82. The `ProxyPreserveHost` setting will make sure the `Host` header is kept the same as in the original request. Without that, the `Host` is set to `localhost:82` and so Varnish can't differentiate requests to different vhosts and so does one big cache rather than one per vhost.

```
<IfModule mod_proxy.c>
	ProxyRequests Off
	ProxyPreserveHost on
	ProxyPass /.well-known/acme-challenge/ !
	ProxyPass "/" "http://localhost:82/"
	ProxyPassReverse "/" "http://localhost:82/"
</IfModule>
```

## Revel

Set the revel app to listen on port 9090

Start with

```
revel run -a github.com/digininja/cachepoisoner/
```

To remove the built in cookies:

<https://github.com/revel/revel/issues/323>

## References

[Varnish tutorial](https://www.varnish-software.com/wiki/content/tutorials/varnish/varnish_ubuntu.html)

[Burp blog post](https://portswigger.net/blog/practical-web-cache-poisoning)
