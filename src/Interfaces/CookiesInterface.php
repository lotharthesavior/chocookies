<?php

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
     * Get an expired version of a cookie.
     *
     * @param ServerRequestInterface $request
     * @param string $key
     * @return string
     */
    public static function getExpiredCookie(ServerRequestInterface $request, string $key): string;
}
