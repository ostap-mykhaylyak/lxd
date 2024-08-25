<?php

namespace Servals\Lxd\Endpoint;

/**
 * Server class
 *
 * This class handles operations related to the LXD server, such as retrieving server information.
 *
 * @package Servals\Lxd\Endpoint
 */
class Server extends AbstractEndpoint
{
    /**
     * Retrieves server information.
     *
     * @return array The server information from the API.
     */
    public function info()
    {
        return $this->get('/1.0');
    }

    /**
     * Retrieves server configuration.
     *
     * @return array The server configuration from the API.
     */
    public function config()
    {
        return $this->get('/1.0/config');
    }

    /**
     * Updates server configuration.
     *
     * @param array $data The configuration data to update.
     * 
     * @return array The response from the API.
     */
    public function updateConfig(array $data)
    {
        return $this->put('/1.0/config', $data);
    }
}