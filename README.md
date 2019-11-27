# Cache Poison Lab

A lab to play with web cache poisoning

## Setting up the environment

### Apache

The following proxy modules must both be enabled:

* proxy
* proxy_http

```
a2enmod proxy proxy_http
```

### Varnish

You can't edit `/etc/default/varnish` any more, it is ignored. See this

<https://github.com/varnish/Varnish-Cache/pull/92#>

Edit `/etc/systemd/system/varnish.service` or `/etc/systemd/system/multi-user.target.wants/varnish.service` and change the `ExecStart` line to this:

```
ExecStart=/usr/sbin/varnishd -j unix,user=vcache -F -a :81 -T localhost:6082 -f /etc/varnish/poison.vcl -S /etc/varnish/secret -s malloc,256m
```

`-a` says to listen on the host:port specified.
`-T` is the management interface - keep this to localhost or set it to `none` to disable it.
`-f` is the config file to use. Make sure this is copied out of the repo and into the expected directory.

After changing the service file, you need to reload it:

```
systemctl daemon-reload
```

## References

[Varnish tutorial](https://www.varnish-software.com/wiki/content/tutorials/varnish/varnish_ubuntu.html)

[Burp blog post](https://portswigger.net/blog/practical-web-cache-poisoning)

## Hints

### Basic Lab

```
curl http://42127f-poison.digi.ninja:81/basic.php -H "X-Forwarded-Host: test.com\"><script>alert(1)</script>"
```


