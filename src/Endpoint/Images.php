<?php

namespace Servals\Lxd\Endpoint;

/**
 * Images class
 *
 * This class handles operations related to LXD images, such as listing images, retrieving information, and creating or deleting images.
 *
 * @package Servals\Lxd\Endpoint
 */
class Images extends AbstractEndpoint
{
    /**
     * Lists all images.
     *
     * @return array The list of images from the API.
     */
    public function list()
    {
        return $this->get('/1.0/images');
    }

    /**
     * Retrieves information about a specific image.
     *
     * @param string $fingerprint The fingerprint of the image.
     * 
     * @return array The image information from the API.
     */
    public function info($fingerprint)
    {
        return $this->get("/1.0/images/{$fingerprint}");
    }

    /**
     * Creates a new image.
     *
     * @param array $data The data needed to create an image.
     * 
     * @return array The response from the API.
     */
    public function create(array $data)
    {
        return $this->post('/1.0/images', $data);
    }

    /**
     * Deletes an image.
     *
     * @param string $fingerprint The fingerprint of the image to delete.
     * 
     * @return array The response from the API.
     */
    public function delete($fingerprint)
    {
        return $this->delete("/1.0/images/{$fingerprint}");
    }
}