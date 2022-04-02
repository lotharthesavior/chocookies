<?php

namespace Chocookies;

use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface CookiesInterface
{
    public static function setCookie(
        ResponseInterface|ServerRequestInterface &$serverObject,
        string $cookieKey,
        string $cookieValue,
        ?Carbon $expireHour = null
    ): void;

    public static function expireCookie(
        ServerRequestInterface $request,
        ResponseInterface &$response,
        string $key
    ): void;

    public static function getExpiredCookie(ServerRequestInterface $request, string $key): string;

    public static function getCookie(ResponseInterface|ServerRequestInterface $serverObject, string $key): array;

    public static function encodeData(array $data): string;

    public static function parseData(string $data): array;
}
