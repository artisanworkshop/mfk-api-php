<?php
/**
 * Money Forward Kessai API HTTP Client
 * 
 * @category HttpClient
 * @package Artisanworkshop/MFKessai
 */

namespace Artisanworkshop\MFKessai;

use Artisanworkshop\MFKessai\HttpClient\Options as Options;
use Artisanworkshop\MFKessai\HttpClient\Request as Request;
use Artisanworkshop\MFKessai\HttpClient\Response as Response;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\BadResponseException as GuzzleBadResponseException;


/**
 * Money Forward Kessai API HTTP Client Class
 * 
 * @category HttpClient
 * @package Artisanworkshop/MFKessai
 */
class HttpClient
{

    /**
     * API Key.
     * 
     * @var string
     */
    protected $apikey;

    /**
     * Sandbox.
     * 
     * @var bool
     */
    protected $sandbox;

    /**
     * Client options.
     *
     * @var Options
     */
    protected $options;

    /**
     * Request.
     *
     * @var Request
     */
    private $request;

    /**
     * Response.
     *
     * @var Response
     */
    private $response;

    /**
     * Initialize HTTP Client.
     * 
     * @param string $apikey         apikey.
     * @param bool   $sandbox        If sandbox is true.
     * @param array  $options        Options (version, timeout, verify_ssl, oauth_only).
     */
    public function __construct($apikey, $sandbox, $options = [])
    {
        $this->apikey = $apikey;
        $this->sandbox = $sandbox;
        $this->options = new Options($options);
    }

    /**
     * Build API URL.
     *
     * @param string $requwst_type   Request Type.
     * @param bool   $sandbox        If sandbox is true.
     *
     * @return string
     */
    protected function buildApiUrl($sandbox)
    {
        $api_url = $sandbox ? Client::API_SANDBOX_URL : Client::API_PRODUCTION_URL;
        $api_url .= '/' . $this->options->getVersion() . '/';
        return $api_url;
    }

    /**
     * Create response.
     *
     * @return Response
     */
    protected function createResponse( $response )
    {
        // Register response.
        $this->response = new Response($response->getCode(), $response->getHeaders(), $response->getBody());
        return $this->getResponse();
    }

    /**
     * Process response.
     *
     * @return \stdClass
     */
    protected function processResponse()
    {
        $body = $this->response->getBody();
        $parsedResponse = \json_decode($body);
        return $parsedResponse;
    }

    /**
     * Request API.
     *
     * @param string $endpoint API endpoint.
     * @param string $method   Request method.
     * @param string $data     Request Json data.
     *
     * @return string $result  Json Response.
     */
    public function request($endpoint, $method, $data)
    {
        $api_url = $this->buildApiUrl( $this->sandbox );
/*        ([
            'base_uri' => $api_url,
            'timeout' => $this->options['timeout'] ?? 10,
            'verify' => $this->options['verify_ssl'] ?? true,
        ]);*/
        $endpoint = $api_url . $endpoint;
        $header = [
            'Accept' => 'application/json',
            'apikey' => $this->apikey
        ];
        if(!empty($data)){
            $header['Content-Type'] = 'application/json';
        }
        $client = new GuzzleClient();
        try{
            $response = $client->request($method, $endpoint, [
                'headers' => $header,
                'body' => $data,
            ]);
            // Get response.
            $result = $this->createResponse( $response );
        } catch (GuzzleBadResponseException $e) {
            // handle exception or api errors.
            $result = $e->getResponse()->getBody()->getContents();
        }
        return $result;
    }

    /**
     * Get request data.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get response data.
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}