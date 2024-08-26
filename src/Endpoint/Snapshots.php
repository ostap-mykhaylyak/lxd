<?php

namespace Servals\Lxd\Endpoint;

/**
 * Snapshots class
 *
 * This class handles operations related to LXD instance snapshots.
 *
 * @package Servals\Lxd\Endpoint
 */
class Snapshots extends AbstractEndpoint
{
    /**
     * Lists all snapshots for a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * 
     * @return array The list of snapshots for the instance.
     */
    public function list($instanceName)
    {
        return $this->get("/1.0/instances/{$instanceName}/snapshots");
    }

    /**
     * Creates a snapshot for a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * @param string $snapshotName The name of the snapshot.
     * @param bool $stateful Whether to create a stateful snapshot.
     * 
     * @return array The response from the API after creating the snapshot.
     */
    public function create($instanceName, $snapshotName, $stateful = false)
    {
        $data = [
            'name' => $snapshotName,
            'stateful' => $stateful,
        ];

        return $this->post("/1.0/instances/{$instanceName}/snapshots", $data);
    }

    /**
     * Restores an instance from a specific snapshot.
     *
     * @param string $instanceName The name of the instance.
     * @param string $snapshotName The name of the snapshot to restore from.
     * 
     * @return array The response from the API after restoring the instance.
     */
    public function restore($instanceName, $snapshotName)
    {
        $data = [
            'restore' => $snapshotName,
        ];

        return $this->put("/1.0/instances/{$instanceName}", $data);
    }

    /**
     * Deletes a specific snapshot for an instance.
     *
     * @param string $instanceName The name of the instance.
     * @param string $snapshotName The name of the snapshot to delete.
     * 
     * @return array The response from the API after deleting the snapshot.
     */
    public function delete($instanceName, $snapshotName)
    {
        return $this->delete("/1.0/instances/{$instanceName}/snapshots/{$snapshotName}");
    }
}