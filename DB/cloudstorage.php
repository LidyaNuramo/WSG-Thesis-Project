<?php

require '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

// Providing the Google Cloud project ID.
// $storage = new StorageClient([
//     'projectId' => 'wsg-thesis-project-359600'
// ]);

$storage = new StorageClient([
    'keyFile' => json_decode(file_get_contents('../credentials/svcaccount.JSON'), true)
]);

$bucket = $storage->bucket('mytravelrental-bucket');

try {
    $bucket->upload(
        "Test file",
        ['name' => "Test.txt"]
    );
}

catch (Exception $e) {
    // maybe invalid private key ?
    print $e;
}


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