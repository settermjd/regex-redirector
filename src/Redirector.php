<?php

namespace RegexRedirector;

/**
 * Class RegexRedirector
 *
 * A small class to help with redirecting requests from absolute URLs, if required.
 *
 * @package RegexRedirector
 */
class Redirector
{
    /**
     * @var array
     */
    private $redirectList;

    /**
     * @var string
     */
    private $requestUrl;

    /**
     * Initialise the object with the redirect list and requested URL
     *
     * @param array $redirectList
     * @param string $requestUrl
     */
    public function __construct($redirectList = [], $requestUrl)
    {
        $this->redirectList = $redirectList;
        $this->requestUrl = $requestUrl;
    }

    /**
     * Test if the requested URL require a redirect.
     *
     * @return bool
     */
    public function requiresRedirect()
    {
        foreach (array_keys($this->redirectList) as $pattern) {
            if (strpos($this->requestUrl, $pattern) !== FALSE) {
                return $pattern;
            }
        }

        return false;
    }

    /**
     * Get the URL to redirect to, based on the requested URL, if a redirect is required
     *
     * @return bool|string
     */
    public function getRedirectUrl()
    {
        if (($pattern = $this->requiresRedirect()) != false) {
            return str_replace($pattern, $this->redirectList[$pattern], $this->requestUrl);
        }
        return false;
    }
}
