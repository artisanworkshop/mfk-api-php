<?php
/**
 * Money Forward Kessai API HTTP Client Response
 * 
 * @category HttpClient
 * @package Artisanworkshop/MFKessai
 */

namespace Artisanworkshop\MFKessai\HttpClient;

/**
 * Money Forward Kessai API HTTP Client Response Class
 * 
 * @package Artisanworkshop/MFKessai
 */
class Response
{
    /**
     * Response body.
     *
     * @var string
     */
    private $body;

    /**
     * Response headers.
     *
     * @var array
     */
    private $headers;

    /**
     * Response status code.
     *
     * @var int
     */
    private $code;

    /**
     * Initialize response.
     *
     * @param string $body        Response body.
     * @param array  $headers     Response headers.
     * @param int    $code        Response code.
     */
    public function __construct($body = '', $headers = [], $code = 0)
    {
        $this->body = $body;
        $this->headers = $headers;
        $this->code = $code;
    }

    /**
     * Set code.
     *
     * @param int $code Response code.
     */
    public function setCode($code)
    {
        $this->code = (int) $code;
    }

    /**
     * Set headers.
     *
     * @param array $headers Response headers.
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set body.
     *
     * @param string $body Response body.
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get response body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get response headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get response status code.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
}