<?php
/** Money Forward Kessai API HTTP Client Options
 * 
 * @category HttpClient
 * @package Artisanworkshop/MFKessai
 */

namespace Artisanworkshop\MFKessai\HttpClient;

/**
 * Money Forward Kessai API HTTP Client Options Class
 * 
 * @package Artisanworkshop/MFKessai
 */
class Options
{
        /**
     * Default WooCommerce REST API version.
     *
     * @var string
     */
    public const VERSION = 'v2';

    /**
     * Options.
     *
     * @var array
     */
    private $options;

    /**
     * Initialize HTTP client options.
     *
     * @param array $options Client options.
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Get API version.
     *
     * @return string
     */
    public function getVersion()
    {
        return isset($this->options['version']) ? $this->options['version'] : self::VERSION;
    }

}