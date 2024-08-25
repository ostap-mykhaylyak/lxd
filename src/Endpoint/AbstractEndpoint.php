<?php

namespace Servals\Lxd\Endpoint;

use Servals\Lxd\Client;

/**
 * AbstractEndpoint class
 *
 * This abstract class serves as a base for all specific LXD API endpoints.
 * It provides common methods for making HTTP requests.
 *
 * @package Servals\Lxd\Endpoint
 */
abstract class AbstractEndpoint
{
    /**
     * Instance of the Client class to make API requests.
     * 
     * @var \Servals\Lxd\Client
     */
    protected $client;

    /**
     * Constructor for the AbstractEndpoint class.
     *
     * @param \Servals\Lxd\Client $client The client instance to use for requests.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Makes a GET request to the API.
     *
     * @param string $endpoint The API endpoint to target.
     * 
     * @return array The response from the API.
     */
    protected function get($endpoint)
    {
        return $this->client->request('GET', $endpoint);
    }

    /**
     * Makes a POST request to the API.
     *
     * @param string $endpoint The API endpoint to target.
     * @param array $data The data to send in the request body.
     * 
     * @return array The response from the API.
     */
    protected function post($endpoint, $data)
    {
        return $this->client->request('POST', $endpoint, $data);
    }

    /**
     * Makes a PUT request to the API.
     *
     * @param string $endpoint The API endpoint to target.
     * @param array $data The data to send in the request body.
     * 
     * @return array The response from the API.
     */
    protected function put($endpoint, $data)
    {
        return $this->client->request('PUT', $endpoint, $data);
    }

    /**
     * Makes a DELETE request to the API.
     *
     * @param string $endpoint The API endpoint to target.
     * 
     * @return array The response from the API.
     */
    protected function delete($endpoint)
    {
        return $this->client->request('DELETE', $endpoint);
    }
}