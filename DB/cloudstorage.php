<?php

require '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

class Bucket{

    private $storage_bucket = null;
    private $bucket_name = 'mytravelrental-bucket';
    private $key_file = '../credentials/sa.json';

    function __construct() {
	    $this->$storage = $this->storage_client($key_file);
        $this->$storage_bucket = $storage->bucket($bucket_name);
	}

    function upload_file($file_path, $filename, $id){
        try {
            $random = rand(6, 9);
            $this->$storage_bucket->upload(
                fopen($file_path,'r'),
                [
                    'predefinedAcl' => 'publicRead',
                    'name' => $random.$id.$filename
                ]
            );
            return 'https://storage.googleapis.com/mytravelrental-bucket/'.$random.$id.$filename;
        }
        
        catch (Exception $e) {
            // maybe invalid private key ?
            echo $e;
            return "";
        }
    }

    function download_file($file_path,$download_path){
        // Download and store an object from the bucket locally.
        $object = $this->$storage_bucket->object($file_path);
        $object->downloadToFile($download_path);
    }

    function publicate_file($file_path){
        // Using Predefined ACLs to manage object permissions, you may
        // upload a file and give read access to anyone with the URL.
        $storage_bucket->upload(
            fopen($file_path, 'r'),
            [
                'predefinedAcl' => 'publicRead'
            ]
        );
    }

    private function storage_client($key_file) {
        try {
            $storage = new StorageClient([
                'keyFilePath' => $key_file,
            ]);
            return $storage;
        }
        catch (Exception $e) {
            // maybe invalid private key ?
            echo $e;
        }
	}

}

?>