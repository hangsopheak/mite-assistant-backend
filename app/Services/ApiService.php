<?php

namespace App\Services;
use App;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Traits\ApiResponser;


class ApiService
{
	use ValidatesRequests, ApiResponser;
	const IMAGE_BASE_URL = "https://app-assets.smart.com.kh/smartnas";
	
	protected function generateFullPath($imageName, $directory, $deviceType, $size){
		if($deviceType == null || $size == null || $imageName == null) return null;
		return self::IMAGE_BASE_URL."/".$directory."/".$deviceType.'/'.$size.'/'.$imageName;
	}
}