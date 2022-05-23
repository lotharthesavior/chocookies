<?php

declare(strict_types=1);

namespace Tests;

use Chocookies\Cookies;
use GuzzleHttp\Psr7\HttpFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class CookiesTest extends TestCase
{
    protected RequestInterface $request;
    protected ResponseInterface $response;

    protected function setUp(): void
    {
        $httpFactory = new HttpFactory;
        $this->response = $httpFactory->createResponse();
        $this->request = $httpFactory->createServerRequest('GET', '/');
    }

    public function test_can_set_cookies()
    {
        $key = 'test-key';
        $value = 'test-value';

        Cookies::setCookie($this->request, $key, $value);
        $this->assertNotFalse(strpos(current($this->request->getHeader('Set-Cookie')), $value));

        Cookies::setCookie($this->response, $key, $value);
        $this->assertNotFalse(strpos(current($this->response->getHeader('Set-Cookie')), $value));
    }

    public function test_can_get_cookies()
    {
        $key = 'test-key';
        $value = 'test-value';

        $this->request = $this->request->withCookieParams([$key => $value]);

        $cookie = Cookies::getCookie($this->request, $key);
        $this->assertEquals($value, $cookie);
    }
}