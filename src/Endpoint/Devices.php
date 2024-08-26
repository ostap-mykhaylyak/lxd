<?php

namespace Servals\Lxd\Endpoint;

/**
 * Devices class
 *
 * This class handles operations related to devices within LXD instances.
 *
 * @package Servals\Lxd\Endpoint
 */
class Devices extends AbstractEndpoint
{
    /**
     * Retrieves the list of devices for a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * 
     * @return array The list of devices configured for the instance.
     */
    public function list($instanceName)
    {
        $info = $this->get("/1.0/instances/{$instanceName}");
        return $info['metadata']['devices'] ?? [];
    }

    /**
     * Adds a device to a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * @param string $deviceName The name of the device.
     * @param array $deviceConfig The configuration for the device.
     * 
     * @return array The response from the API after adding the device.
     */
    public function add($instanceName, $deviceName, array $deviceConfig)
    {
        $data = [
            'devices' => [
                $deviceName => $deviceConfig
            ]
        ];

        return $this->patch("/1.0/instances/{$instanceName}", $data);
    }

    /**
     * Removes a device from a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * @param string $deviceName The name of the device to remove.
     * 
     * @return array The response from the API after removing the device.
     */
    public function remove($instanceName, $deviceName)
    {
        $data = [
            'devices' => [
                $deviceName => null
            ]
        ];

        return $this->patch("/1.0/instances/{$instanceName}", $data);
    }
}