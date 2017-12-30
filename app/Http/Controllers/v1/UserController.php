<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userService;

    public function __construct(userService $userService)
    {
         $this->userService = $userService;
    }


    /**
     * Store a newly created resource in storage.
	 * @param string $lang
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store( Request $request)
    {
    	
    	return $this->userService->create( $request);
    }

    

	/**
     * Change password for existing user
	 * @param string $lang
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    public function changePassword($lang, $id, Request $request){
    	return $this->userService->changePassword($lang, $id, $request);
    }
	
   /**
    * @param Request $request
    * @return \Illuminate\Http\Response
    */
    public function updatePassword($lang, $id, Request $request){
    	return $this->userService->updatePassword($lang, $id, $request);
    }
	/**
	 * 
	 * @param String $lang
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
	 */
    public function login(Request $request){
    	return $this->userService->login( $request);
    }
    
    /**
     * Display the specified resource.
	 * @param string $lang
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return $this->userService->show($id);
    }


}
