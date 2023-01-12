<?php
require '../vendor/autoload.php';
class Bucket{
    use Google\Cloud\Storage\StorageClient;
    private $storage_bucket = null;
    private $keypath = "../credentials/sa.JSON";

    function __construct() {
	    $storage = $this->storage_client($this->$keypath);
        $this->$storage_bucket = $storage->bucket('mytravelrental-bucket');
	}
    function upload_file(){
        try {
            $this->$storage_bucket->upload(
                "Test file",
                ['name' => "Test.txt"]
            );
        }

        catch (Exception $e) {
            // maybe invalid private key ?
            echo $e;
        }
    }
    private function storage_client($path) {
		$storage = new StorageClient([
            'keyFile' => json_decode(file_get_contents($path), true)
        ]);
		if (!$connection) {
			echo " Cloud Storage Connection error.";
			exit;
		}
		else{
			return $connection;
		} 
	}

}

?>