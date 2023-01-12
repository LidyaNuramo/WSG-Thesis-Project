<?php

require '../vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

class Bucket{

    private $storage_bucket = null;
    private $bucket_name = 'mytravelrental-bucket';
    private $key_file = '../credentials/sa.json';

    function __construct() {
	    $storage = $this->storage_client($key_file);
        $this->$storage_bucket = $storage->bucket($bucket_name);
	}

    function upload_file($file_path, $filename, $id){
        try {
            $this->$storage_bucket->upload(
                fopen($file_path,'r'),
                [
                    'predefinedAcl' => 'publicRead',
                    'name' => 'AssetsPictures/'.$id.'/'.$filename
                ]
            );
            return 'https://storage.googleapis.com/mytravelrental-bucket/AssetsPictures/'.$id.'/'.$filename;
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

    private function storage_client($key_file) {
		$storage = new StorageClient();
		if (!$storage) {
			echo " Cloud Storage Connection error.";
			exit;
		}
		else{
			return $storage;
		} 
	}

}

$bucket = new Bucket();
$bucket.upload_file();

?>