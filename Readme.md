
# Chocookie

Package for Cookie management through [Psr7](https://www.php-fig.org/psr/psr-7/) standards.

## Installation

Install with composer:

```shell
composer require lotharthesavior/chocookies
```

## Usage

```php
use Chocookies\Cookies;

Cookies::setCookie($requestOrResponse, 'my-cookie-key', 'my-cookie-data');
Cookies::getCookie($requestOrResponse, 'my-cookie-key');
```

Interface:

```php
namespace Chocookies\Interfaces;

use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface CookiesInterface
{
    /**
     * Set Cookie.
     *
     * @param ResponseInterface|ServerRequestInterface $serverObject
     * @param string $cookieKey
     * @param string $cookieValue
     * @param Carbon|null $expireHour
     * @return void
     */
    public static function setCookie(
        ResponseInterface|ServerRequestInterface &$serverObject,
        string $cookieKey,
        string $cookieValue,
        ?Carbon $expireHour = null
    ): void;

    /**
     * Retrieve cookie by the key.
     *
     * @param ResponseInterface|ServerRequestInterface $serverObject
     * @param string $key
     * @return string|null
     */
    public static function getCookie(ResponseInterface|ServerRequestInterface $serverObject, string $key): ?string;

    /**
     * Expire cookie at the ResponseInterface object.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param string $key
     * @return void
     */
    public static function expireCookie(
        ServerRequestInterface $request,
        ResponseInterface &$response,
        string $key
    ): void;

    /**
     * Get an expired version of a cookie. Used to expire cookies.
     *
     * @param ServerRequestInterface $request
     * @param string $key
     * @return string
     */
    public static function getExpiredCookie(ServerRequestInterface $request, string $key): string;
}
```
