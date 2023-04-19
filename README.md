# Cache Poison Lab

The code behind my [Web Cache Poisoning Lab](https://poison.digi.ninja/).

I'm making this public four years after I put the lab live. I can't remember much about how all this works so if you have questions, I can try to answer them but may struggle.

The notes here are the notes I made when I set it all up, they are not release ready but I've not got time to tidy them up.

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

This will help when setting up for the redirection lab <https://varnish-cache.org/docs/3.0/tutorial/devicedetection.html>.

#### Custom Hashing

<https://serverfault.com/questions/754613/how-to-hash-based-on-host-path-in-varnish>
<https://varnish-cache.org/docs/trunk/users-guide/vcl-hashing.html>

Probably want to write a custom hash sub which ignores the host and just looks at the URL, maybe:

```
sub vcl_hash {
	hash_data(req.url);
	return (lookup);
}
```

## References

[Varnish tutorial](https://www.varnish-software.com/wiki/content/tutorials/varnish/varnish_ubuntu.html)

[Burp blog post](https://portswigger.net/blog/practical-web-cache-poisoning)

[Custom Hashes](https://varnish-cache.org/docs/trunk/users-guide/vcl-hashing.html) - Not related to the project, but interesting comment that hashing is based on Host header which is case sensitive. Wonder if things get leaked when providing upper case Host?

## Hints

### Basic Lab

```
curl https://42127f-poison.digi.ninja:2443/basic.php -H "X-Forwarded-Host: test.com\"><script>alert(1)</script>"
```

### Routing

```
curl "https://2d31c7e7a.poison.digi.ninja:2443/routing.php" -H "X-forwarded-host: digi.ninja" -i
```
