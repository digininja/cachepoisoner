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

## Revel

Set the revel app to listen on port 9090

Start with

```
revel run -a github.com/digininja/cachepoisoner/
```

## References

[Varnish tutorial](https://www.varnish-software.com/wiki/content/tutorials/varnish/varnish_ubuntu.html)

[Burp blog post](https://portswigger.net/blog/practical-web-cache-poisoning)
