<?php

require '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Providing the Google Cloud project ID.
$storage = new StorageClient([
    'projectId' => 'wsg-thesis-project-359600'
]);

$bucket = $storage->bucket('mytravelrental-bucket');

$bucket->upload(
    fopen('cloudsql.php', 'r')
);

// Using Predefined ACLs to manage object permissions, you may
// upload a file and give read access to anyone with the URL.
// $bucket->upload(
//     fopen('/data/file.txt', 'r'),
//     [
//         'predefinedAcl' => 'publicRead'
//     ]
// );

// Download and store an object from the bucket locally.
// $object = $bucket->object('file_backup.txt');
// $object->downloadToFile('/data/file_backup.txt');

?>