<?php

namespace Servals\Lxd\Endpoint;

/**
 * Backups class
 *
 * This class handles operations related to LXD instance backups.
 *
 * @package Servals\Lxd\Endpoint
 */
class Backups extends AbstractEndpoint
{
    /**
     * Lists all backups for a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * 
     * @return array The list of backups for the instance.
     */
    public function list($instanceName)
    {
        return $this->get("/1.0/instances/{$instanceName}/backups");
    }

    /**
     * Creates a backup for a specific instance.
     *
     * @param string $instanceName The name of the instance.
     * @param string $backupName The name of the backup.
     * @param bool $optimized Whether to create an optimized backup.
     * 
     * @return array The response from the API after creating the backup.
     */
    public function create($instanceName, $backupName, $optimized = false)
    {
        $data = [
            'name' => $backupName,
            'optimized_storage' => $optimized,
            'instance_only' => false,  // Set to true if only the instance config should be backed up, without snapshots.
        ];

        return $this->post("/1.0/instances/{$instanceName}/backups", $data);
    }

    /**
     * Restores an instance from a specific backup.
     *
     * @param string $instanceName The name of the instance.
     * @param string $backupName The name of the backup to restore from.
     * 
     * @return array The response from the API after restoring the instance.
     */
    public function restore($instanceName, $backupName)
    {
        return $this->post("/1.0/instances/{$instanceName}/backups/{$backupName}/restore");
    }

    /**
     * Deletes a specific backup for an instance.
     *
     * @param string $instanceName The name of the instance.
     * @param string $backupName The name of the backup to delete.
     * 
     * @return array The response from the API after deleting the backup.
     */
    public function delete($instanceName, $backupName)
    {
        return $this->delete("/1.0/instances/{$instanceName}/backups/{$backupName}");
    }
}