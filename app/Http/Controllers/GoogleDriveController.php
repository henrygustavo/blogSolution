<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DebugBar;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Config;
use App\Services\FileManagerInterface;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\JWTAuth;

class GoogleDriveController extends Controller
{
  protected $fileManager;
  protected $jwt;

  public function __construct(FileManagerInterface $fileManager,JWTAuth $jwt) {
      $this->jwt = $jwt;
      $this->fileManager = $fileManager;
        // Apply the jwt.auth middleware to all methods in this controller
        $this->middleware('jwt.auth.permissions:admin', ['except' => ['getImageProfile']]);
        
  }
    
  public function getImageFolders(){
          
        Log::info('config google image folder.'.Config::get('google.blog_folder_image_id'));
        $result = $this->fileManager ->getFolders(Config::get('google.blog_folder_image_id'));
         
        return response()->json($result->listContents());
    }
    
    public function getFileFolders(){
          
        Log::info('config google file folder.'.Config::get('google.blog_folder_file_id'));
        $result = $this->fileManager ->getFolders(Config::get('google.blog_folder_file_id'));
         
        return response()->json($result->listContents());
    }
    
   public function getImages($folderId){
        
        $result = $this->fileManager ->getFiles($folderId);
         
        return response()->json(DateHelper::convertToListImage($result->listContents()));
    }
    
    public function getFiles($folderId){
        
        $result = $this->fileManager ->getFiles($folderId);
         
        return response($result->listContents());
    }
    
    public function getImageProfile(){
        
        $result = $this->fileManager ->getFiles(Config::get('google.blog_profile_file_id'));
         
        return response($result->listContents());
    }
}
