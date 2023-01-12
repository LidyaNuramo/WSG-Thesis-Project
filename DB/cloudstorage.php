<?php

require '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

class Bucket{

    private $storage_bucket = null;

    function __construct() {
	    $storage = $this->storage_client();
        $this->$storage_bucket = $storage->bucket('mytravelrental-bucket');
	}

    function upload_file(){
        try {
            $this->$storage_bucket->upload(
                "Test file",
                ['name' => "Test2.txt"]
            );
        }
        
        catch (Exception $e) {
            // maybe invalid private key ?
            print $e;
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

    private function storage_client() {
		$storage = new StorageClient();
		if (!$connection) {
			echo " Cloud Storage Connection error.";
			exit;
		}
		else{
			return $connection;
		} 
	}

}

$bucket = new Bucket();
$bucket.upload_file();

?>