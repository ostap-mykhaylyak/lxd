<?php

namespace Servals\Lxd\Endpoint;

/**
 * Profiles class
 *
 * This class handles operations related to LXD profiles.
 *
 * @package Servals\Lxd\Endpoint
 */
class Profiles extends AbstractEndpoint
{
    /**
     * Lists all profiles.
     *
     * @return array The list of profiles from the API.
     */
    public function list()
    {
        return $this->get('/1.0/profiles');
    }

    /**
     * Retrieves information about a specific profile.
     *
     * @param string $profileName The name of the profile.
     * 
     * @return array The profile information from the API.
     */
    public function info($profileName)
    {
        return $this->get("/1.0/profiles/{$profileName}");
    }

    /**
     * Creates a new profile.
     *
     * @param string $profileName The name of the profile to create.
     * @param array $config Configuration options for the profile (optional).
     * @param array $devices Devices to attach to the profile (optional).
     * 
     * @return array The response from the API after creating the profile.
     */
    public function create($profileName, array $config = [], array $devices = [])
    {
        $data = [
            'name' => $profileName,
            'config' => $config,
            'devices' => $devices
        ];

        return $this->post('/1.0/profiles', $data);
    }

    /**
     * Updates an existing profile.
     *
     * @param string $profileName The name of the profile to update.
     * @param array $config New configuration options for the profile.
     * @param array $devices New devices to attach to the profile.
     * 
     * @return array The response from the API after updating the profile.
     */
    public function update($profileName, array $config, array $devices = [])
    {
        $data = [
            'config' => $config,
            'devices' => $devices
        ];

        return $this->put("/1.0/profiles/{$profileName}", $data);
    }

    /**
     * Deletes a profile.
     *
     * @param string $profileName The name of the profile to delete.
     * 
     * @return array The response from the API after deleting the profile.
     */
    public function delete($profileName)
    {
        return $this->delete("/1.0/profiles/{$profileName}");
    }
}