# Caller Info

```
composer require php-tool-bucket/caller-info
```

Returns the true caller information by getting rid of superfluous entries in the
backtrace, such as `require()` and `eval()` calls. For example if `bar()` requires a file
which calls `baz()`, the caller of `baz()` would be `bar()`, rather than `require()`.
