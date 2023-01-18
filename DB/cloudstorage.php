<?php

require '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

class Bucket{

    private $storage_bucket = null;
    private $bucket_name = 'mytravelrental-bucket';
    private $keypath = '../credentials/sa.json';

    function __construct() {
        $storage = $this->storage_client($this->keypath);
        $this->storage_bucket = $storage->bucket($this->bucket_name);
	}

    function upload_file($file_path, $filename, $id){
        try {
            $random = rand(1000000000, 9999999999);
            $name = $random."_".$id."_".$filename;
            $this->storage_bucket->upload(
                fopen(realpath($file_path),'r'),
                ['predefinedAcl' => 'publicRead',
                'name' => $name]
            );
            $url = 'https://storage.googleapis.com/mytravelrental-bucket/'.$name;
            return $url;
        }
        
        catch (Exception $e) {
            echo $e;
        }
    }

    function download_file($file_path,$download_path){
        // Download and store an object from the bucket locally.
        $object = $this->storage_bucket->object($file_path);
        $object->downloadToFile($download_path);
    }

    private function storage_client($key_file) {
        $storage = new StorageClient([
            'keyFile' => json_decode(file_get_contents($key_file), true)
        ]);
        if (!$storage) {
            echo " Cloud Storage Connection error.";
            exit;
        }
        else{
            return $storage;
        } 
	}

}

?>