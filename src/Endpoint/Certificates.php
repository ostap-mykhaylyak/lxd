<?php

namespace Servals\Lxd\Endpoint;

/**
 * Certificates class
 *
 * This class handles operations related to LXD certificates, such as adding a trusted certificate.
 *
 * @package Servals\Lxd\Endpoint
 */
class Certificates extends AbstractEndpoint
{
    /**
     * Adds a new trusted certificate.
     *
     * @param string $cert The certificate content.
     * @param string $password The password required to add the certificate.
     * 
     * @return array The response from the API.
     */
    public function add($cert, $password)
    {
        $data = [
            'type' => 'client',
            'certificate' => base64_encode($cert),
            'password' => $password
        ];

        return $this->post('/1.0/certificates', $data);
    }
}