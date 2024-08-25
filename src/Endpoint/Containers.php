<?php

namespace Servals\Lxd\Endpoint;

/**
 * Containers class
 *
 * This class handles operations related to LXD containers such as creation, deletion, and listing.
 *
 * @package Servals\Lxd\Endpoint
 */
class Containers extends AbstractEndpoint
{
    /**
     * Creates a new container.
     *
     * @param array $data The data needed to create a container.
     * 
     * @return array The response from the API.
     */
    public function create(array $data)
    {
        return $this->post('/1.0/containers', $data);
    }

    /**
     * Lists all containers.
     *
     * @return array The list of containers from the API.
     */
    public function list()
    {
        return $this->get('/1.0/containers');
    }

    /**
     * Deletes a container by name.
     *
     * @param string $name The name of the container to delete.
     * 
     * @return array The response from the API.
     */
    public function delete($name)
    {
        return $this->delete("/1.0/containers/{$name}");
    }
}