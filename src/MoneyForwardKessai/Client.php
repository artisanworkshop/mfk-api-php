<?php
/**
 * Money Forward Kessai API Client
 *
 * @category Client
 * @package  Artisanworkshop/MFKessai
 */

namespace Artisanworkshop\MFKessai;

use Artisanworkshop\MFKessai\HttpClient as HttpClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;

/**
 * Money Forward Kessai API Client
 *
 * @category Client
 * @package  Artisanworkshop/MFKessai
 */
class Client
{
    /**
     * API Production URL.
     *
     * @var string
     */
    public const API_PRODUCTION_URL = 'https://api.mfkessai.co.jp';

    /**
     * API Sandbox URL.
     *
     * @var string
     */
    public const API_SANDBOX_URL = 'https://sandbox-api.mfkessai.co.jp';
    
    /**
     * HttpClient instance.
     *
     * @var HttpClient
     */
    public $http;

    /**
     * Initialize client.
     *
     * @param string $apikey         apikey.
     * @param bool   $sandbox        If sandbox is true.
     * @param array  $options        Options (version, timeout, verify_ssl, oauth_only).
     */
    public function __construct( $apikey, $sandbox = false, $options = [] )
    {
        $this->http = new HttpClient( $apikey, $sandbox, $options );
    }

    /**
     * POST method.
     *
     * @param string $endpoint API endpoint.
     * @param array  $data     Request data.
     *
     * @return \stdClass
     */
    public function post($endpoint, $data)
    {
        return $this->http->request($endpoint, 'POST', $data);
    }

    /**
     * PUT method.
     *
     * @param string $endpoint API endpoint.
     * @param array  $data     Request data.
     *
     * @return \stdClass
     */
    public function put($endpoint, $data)
    {
        return $this->http->request($endpoint, 'PUT', $data);
    }

    /**
     * GET method.
     *
     * @param string $endpoint   API endpoint.
     * @param array  $parameters Request parameters.
     *
     * @return \stdClass
     */
    public function get($endpoint, $parameters = [])
    {
        return $this->http->request($endpoint, 'GET', [], $parameters);
    }

    /**
     * DELETE method.
     *
     * @param string $endpoint   API endpoint.
     * @param array  $parameters Request parameters.
     *
     * @return \stdClass
     */
    public function delete($endpoint, $parameters = [])
    {
        return $this->http->request($endpoint, 'DELETE', [], $parameters);
    }
}