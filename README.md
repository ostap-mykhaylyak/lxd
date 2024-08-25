# lxd
 
```
require 'vendor/autoload.php';

$client = new \Servals\Lxd\Client([
    'host' => 'https://127.0.0.1:8443',
    'cert' => '/path/to/client.crt',
    'key'  => '/path/to/client.key',
]);

$result = $client->container->create([
    'name' => 'my-container',
    'source' => [
        'type' => 'image',
        'fingerprint' => 'some_image_fingerprint'
    ]
]);

$containers = $client->container->list();
```