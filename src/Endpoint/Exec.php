<?php

namespace Servals\Lxd\Endpoint;

/**
 * Exec class
 *
 * This class handles the execution of commands inside LXD instances.
 *
 * @package Servals\Lxd\Endpoint
 */
class Exec extends AbstractEndpoint
{
    /**
     * Executes a command inside a specific instance and retrieves the output.
     *
     * @param string $name The name of the instance.
     * @param string $command The command to execute.
     * @param array $environment Optional environment variables to set for the command.
     * 
     * @return array The output from the command execution.
     * @throws \Exception If the command fails or the output cannot be retrieved.
     */
    public function execute($name, $command, array $environment = [])
    {
        // Prepare the request data
        $data = [
            'command' => [$command],
            'environment' => $environment
        ];

        // Send the command execution request
        $response = $this->post("/1.0/instances/{$name}/exec", $data);

        // Check if the response contains a process ID
        if (isset($response['processes']) && is_array($response['processes'])) {
            // Retrieve the process ID
            $processId = $response['processes'][0]['id'];

            // Poll the process status to get the command output
            while (true) {
                $status = $this->get("/1.0/instances/{$name}/exec/{$processId}");
                
                if ($status['metadata']['status'] === 'Stopped') {
                    // Return the output if the command has finished executing
                    return $status['metadata'];
                }

                // Wait before polling again
                sleep(1);
            }
        }

        throw new \Exception("Failed to execute command or retrieve output.");
    }
}