<?php

namespace Servals\Lxd;

/**
 * Client class
 *
 * This class handles the configuration and HTTP requests to the LXD API.
 * It also dynamically initializes endpoints as they are accessed.
 *
 * @package Servals\Lxd
 */
class Client
{
    /**
     * The LXD server host URL.
     * 
     * @var string
     */
    private $host;

    /**
     * Path to the SSL certificate file.
     * 
     * @var string
     */
    private $cert;

    /**
     * Path to the SSL key file.
     * 
     * @var string
     */
    private $key;

    /**
     * Array to store initialized endpoint instances.
     * 
     * @var array
     */
    private $endpoints = [];

    /**
     * Constructor for the Client class.
     *
     * @param array $data Array containing the host, cert, and key.
     */
    public function __construct(array $data)
    {
        $this->host = $data['host'];
        $this->cert = $data['cert'];
        $this->key = $data['key'];
    }

    /**
     * Makes a request to the LXD API.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $endpoint The API endpoint to target.
     * @param array|null $body The body of the request for POST/PUT methods.
     * 
     * @return array The response from the API, decoded from JSON.
     * @throws \Exception If the HTTP status code indicates an error.
     */
    public function request($method, $endpoint, $body = null)
    {
        $url = $this->host . $endpoint;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_SSLCERT, $this->cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $this->key);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode >= 200 && $httpcode < 300) {
            return json_decode($response, true);
        } else {
            throw new \Exception("Error: $httpcode, Response: $response");
        }
    }

    /**
     * Magic __get method to initialize and retrieve an endpoint dynamically.
     *
     * @param string $name The name of the endpoint being accessed.
     * 
     * @return mixed The instance of the requested endpoint.
     * @throws \Exception If the requested endpoint does not exist.
     */
    public function __get($name)
    {
        // Convert the accessed property name into a class name
        $className = 'Servals\\Lxd\\Endpoint\\' . ucfirst($name);

        // Check if the endpoint instance has already been created
        if (!isset($this->endpoints[$name])) {
            if (class_exists($className)) {
                // Dynamically create an instance of the endpoint class
                $this->endpoints[$name] = new $className($this);
            } else {
                // Throw an exception if the class does not exist
                throw new \Exception("Endpoint '$name' not found.");
            }
        }

        // Return the existing instance of the endpoint
        return $this->endpoints[$name];
    }
}