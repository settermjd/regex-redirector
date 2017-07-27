<?php

namespace RegexRedirectorTest;

use PHPUnit\Framework\TestCase;
use RegexRedirector\Redirector;

/**
 * Class RegexRedirectTest
 * @package RedirectorTest
 */
class RedirectTest extends TestCase
{
    /**
     * @dataProvider shouldRedirectData
     * @param array $redirectList
     * @param string $requestUrl
     * @param bool $shouldRedirect
     */
    public function testShouldRedirects($redirectList, $requestUrl, $shouldRedirect)
    {
        $redirector = new Redirector($redirectList, $requestUrl);
        $this->assertSame($shouldRedirect, $redirector->requiresRedirect(), "should require a redirect");
    }

    /**
     * @return array
     */
    public function shouldRedirectData()
    {
        return [
            [
                ['blog-archive' => 'blog'],
                'https://www.matthewsetter.com/blog-archive/',
                'blog-archive'
            ],
            [
                ['configuration_post' => 'configuration/post'],
                'https://www.matthewsetter.com/configuration_post/',
                'configuration_post'
            ],
        ];
    }

    /**
     * @dataProvider redirectData
     * @param array $redirectList
     * @param string $requestUrl
     * @param $redirectUrl
     */
    public function testReturnsCorrectRedirectUrl($redirectList, $requestUrl, $redirectUrl)
    {
        $redirector = new Redirector($redirectList, $requestUrl);
        $this->assertSame($redirectUrl, $redirector->getRedirectUrl(), "redirect URL is incorrect");
    }

    /**
     * @return array
     */
    public function redirectData()
    {
        return [
            [
                ['blog-archive' => 'blog'],
                'https://www.matthewsetter.com/blog-archive',
                'https://www.matthewsetter.com/blog'
            ],
            [
                ['configuration_post' => 'configuration/post'],
                'https://www.matthewsetter.com/configuration_post/',
                'https://www.matthewsetter.com/configuration/post/'
            ],
        ];
    }
}
