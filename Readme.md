
# Chocookie

Package for Cookie management through [Psr7](https://www.php-fig.org/psr/psr-7/) standards.

## Usage

Interface:

```php
interface CookiesInterface
{
    public static function setCookie(ResponseInterface|ServerRequestInterface &$serverObject, string $cookieKey, string $cookieValue, ?Carbon $expireHour = null): void;

    /**
     * Expire cookie at the ResponseInterface object.
     */
    public static function expireCookie(ServerRequestInterface $request, ResponseInterface &$response, string $key): void;

    /**
     * Get an expired version of a cookie.
     */
    public static function getExpiredCookie(ServerRequestInterface $request, string $key): string;

    public static function getCookie(ResponseInterface|ServerRequestInterface $serverObject, string $key): array;

    public static function encodeData(array $data): string;

    public static function parseData(string $data): array;
}
```
