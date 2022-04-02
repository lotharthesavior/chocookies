<?php

namespace Chocookies;

use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Chocookies\Interfaces\CookiesInterface;
use Psr\Http\Message\ServerRequestInterface;

class Cookies implements CookiesInterface
{
    public static function setCookie(
        ResponseInterface|ServerRequestInterface &$serverObject,
        string $cookieKey,
        string $cookieValue,
        ?Carbon $expireHour = null
    ): void {
        if (null === $expireHour) {
            $expireHour = Carbon::now()->addHours(8)->format('D, j F Y H:i:s T');
        } else {
            $expireHour = $expireHour->format('D, j F Y H:i:s T');
        }

        $serverObject = $serverObject->withHeader(
            'Set-Cookie',
            $cookieKey . '=' . $cookieValue . '; Expires=' . $expireHour
        );
    }

    public static function expireCookie(
        ServerRequestInterface $request,
        ResponseInterface &$response,
        string $key
    ): void {
        if (!isset($request->getCookieParams()[$key])) {
            return;
        }

        $response = $response->withHeader(
            'Set-Cookie',
            self::getExpiredCookie($request, $key)
        );
    }

    public static function getExpiredCookie(ServerRequestInterface $request, string $key): string
    {
        $data = self::getCookie($request, $key);
        $expireHour = Carbon::now()->subHour(1)->format('D, j F Y H:i:s T');
        return $key . '=' . Cookies::encodeData($data) . '; Expires=' . $expireHour;
    }

    public static function getCookie(ResponseInterface|ServerRequestInterface $serverObject, string $key): array
    {
        $cookies = $serverObject->getCookieParams();

        if (!isset($cookies[$key])) {
            return [];
        }

        return self::parseData($cookies[$key]);
    }

    public static function encodeData(array $data): string
    {
        return base64_encode(json_encode($data));
    }

    public static function parseData(string $data): array
    {
        $eplodedData = explode(' ', $data);

        if (count($eplodedData) > 0) {
            $data = current($eplodedData);
        }

        return json_decode(base64_decode($data), true);
    }
}