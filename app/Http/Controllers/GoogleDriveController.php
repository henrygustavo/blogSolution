<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileManagerInterface;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
class GoogleDriveController extends Controller
{
	protected $fileManager;
	
	public function __construct(FileManagerInterface $fileManager) {
		
		$this->fileManager = $fileManager;
		// 		Apply the jwt.auth middleware to all methods in this controller
		        //$		this->middleware('jwt.auth.admin.permissions', ['except' => ['getImageProfile']]);
		
	}
	
	public function getImageFolders(){
		
		Log::info('config google image folder.'.Config::get('google.blog_folder_image_id'));
		$result = $this->fileManager ->getFolders(Config::get('google.blog_folder_image_id'));
		
		return response()->json($result->listContents());
	}
}
