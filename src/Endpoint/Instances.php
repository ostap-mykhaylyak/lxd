<?php

namespace Servals\Lxd\Endpoint;

/**
 * Instances class
 *
 * This class handles operations related to LXD instances, such as containers and virtual machines.
 *
 * @package Servals\Lxd\Endpoint
 */
class Instances extends AbstractEndpoint
{
    /**
     * Lists all instances (containers and virtual machines).
     *
     * @return array The list of instances from the API.
     */
    public function list()
    {
        return $this->get('/1.0/instances');
    }

    /**
     * Retrieves information about a specific instance.
     *
     * @param string $name The name of the instance.
     * 
     * @return array The instance information from the API.
     */
    public function info($name)
    {
        return $this->get("/1.0/instances/{$name}");
    }

    /**
     * Creates a new instance (container or VM) from an image alias.
     *
     * @param string $name The name of the instance to create.
     * @param string $imageAlias The alias of the image to use for creating the instance.
     * @param bool $isVM Whether the instance should be a virtual machine (true) or a container (false).
     * @param array $config Additional configuration options for the instance (optional).
     * 
     * @return array The response from the API.
     */
    public function create($name, $imageAlias, $isVM = false, array $config = [])
    {
        $data = [
            'name' => $name,
            'source' => [
                'type' => 'image',
                'alias' => $imageAlias,
            ],
            'type' => $isVM ? 'virtual-machine' : 'container',
            'config' => $config
        ];

        return $this->post('/1.0/instances', $data);
    }

    /**
     * Deletes an instance (container or VM).
     *
     * @param string $name The name of the instance to delete.
     * 
     * @return array The response from the API.
     */
    public function delete($name)
    {
        return $this->delete("/1.0/instances/{$name}");
    }

    /**
     * Starts an instance (container or VM).
     *
     * @param string $name The name of the instance to start.
     * 
     * @return array The response from the API.
     */
    public function start($name)
    {
        return $this->put("/1.0/instances/{$name}/state", ['action' => 'start']);
    }

    /**
     * Stops an instance (container or VM).
     *
     * @param string $name The name of the instance to stop.
     * 
     * @return array The response from the API.
     */
    public function stop($name)
    {
        return $this->put("/1.0/instances/{$name}/state", ['action' => 'stop']);
    }
}