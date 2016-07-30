<?php 

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use League\Flysystem\Filesystem;

class GoogleDrive  implements FileManagerInterface{

    protected $client;

    protected $service;

    function __construct() {
        /* Get config variables */
        $client_id = Config::get('google.client_id');
        $client_secret = Config::get('google.client_secret');
        $refresh_token= Config::get('google.refresh_token');
        
        $this->client = new \Google_Client();
        $this->client->setApplicationName("Blog");        
        $this->client->setClientId($client_id);
        $this->client->setClientSecret($client_secret);
        $this->client->refreshToken($refresh_token);
        
        $this->service = new \Google_Service_Drive($this->client);
        
    }

    public function getFolders($folderId){
       $adapter = new GoogleDriveAdapter($this->service,$folderId);
       $filesystem = new Filesystem($adapter);
        
       return $filesystem;
    }

    public function getFiles($parentFolderId)
    {       
       $adapter = new GoogleDriveAdapter($this->service,$parentFolderId);
       $filesystem = new Filesystem($adapter);
        
       return $filesystem;
    }
}