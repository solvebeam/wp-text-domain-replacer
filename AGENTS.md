# Agent Guidelines for wp-text-domain-replacer

## PHP-Parser: Namespace Resolution Limitation

This project uses PHP-Parser to analyze PHP code. Be aware of this fundamental limitation when writing tests, documentation, or modifying the replacer logic.

### The Problem

PHP-Parser **cannot statically resolve unqualified function names inside a namespace**.

Inside a namespace (e.g., `namespace Foo`), a function call like `__()` could refer to:
- The namespaced version: `\Foo\__()`
- The global WordPress version: `\__()`

PHP-Parser lacks runtime context to determine which one is intended and leaves the reference unresolved.

See: [PHP-Parser Name Resolution documentation](https://github.com/nikic/PHP-Parser/blob/master/doc/component/Name_resolution.markdown)

### Impact on the Text Domain Replacer

The replacer conservatively treats **all unqualified translation function calls** as potential WordPress functions, even inside a namespace. Whether a call is actually modified depends solely on the arguments at the call site — not on whether the function is a custom implementation:

- If the second argument is a **string matching a search domain**, the call **will be modified** — regardless of whether the function is a custom namespaced function or the WordPress translation function.
- If the second argument is **not a string** (e.g., `array`, `int`, `bool`) or does not match any search domain, the call **will not be modified**.

### Test Cases

| File | Behaviour |
|------|-----------|
| `tests/input/custom-namespaced-function.php` | Custom `Test\__()` with identical signature — calls **are modified** (FQN cannot be resolved) |
| `tests/input/custom-args-namespaced-function.php` | Custom `Test\__()` with different argument types (`array`, `int`, `bool`) — calls **are NOT modified** (second argument is not a string matching a search domain) |

### Workaround

To prevent accidental modification, use fully qualified names:

```php
namespace MyPlugin;

// Calls to this WILL be modified by the replacer:
__( 'Text', 'old_domain' );

// Calls to this will NOT be modified (explicitly qualified):
\MyPlugin\__( 'Text', 'old_domain' );
```
