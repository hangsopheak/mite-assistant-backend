<?php

namespace App\Services;
use App\Transformers\UserTransformer;
use DB;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserService extends ApiService
{
	
	
	public function __construct()
	{
		
	}
	
	/**
	 * Create User reseource
	 * @param string $lang
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
	 */
	public function create(Request $request){
        try{

            $rules =  [
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6|strong_password',
                'name' => 'required',
                'phone_number' => 'required',
                'role_id' => 'required|integer|between:1,3'
            ];
            $this->validate($request, $rules);
            $data = $request->all();
            unset($data['password_confirmation']);
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);

            return $this->showOne($user, 201);
        }catch(Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
	}


	public function getAllLecturers(){
	    $lecturers = User::where('status', 1)
                        ->where('role_id', User::ROLE_LECTURER)->get();
        return $this->showAll($lecturers);
    }

	/**
	 * Display the specified resource.
	 * @param string $lang
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function show($id){
		$user = User::findOrFail($id);
		return $this->showOne($user);
	}
	
	/**
	 * Display the specified resource.
	 * @param string $lang
	 * @param  String  $msisdn
	 * @return \Illuminate\Http\Response
	 */
	public function showByEmail($email){
		$users = User::where('status', 1)
						->where('email', $email)->get();
		if($users->count() == 0){
			return $this->errorResponse( 'User does not exist', 404);
		}
		return response($users->first());
	}

	

	/**
	 * Change password for existing user
	 * @param string $lang
	 * @param int $id
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
	 */
	public function changePassword( $id, Request $request){
		$rules = [
				'old_password' => 'required',
				'password'        => 'required|min:6|strong_password',
		];
		$this->validate($request, $rules);
		
		$user = User::findOrFail($id);
		if(!Hash::check($request->old_password, $user->password)){
			return $this->errorResponse(['old_password' => [ __('validation.old_password_not_match')]], 422);
		}
		
		$user->password = bcrypt($request->password);
		try{
			$user->save();
			return $this->showOne($user);
		}catch(Exception $e){
			return $this->errorResponse($e->getMessage(), 500);
		}
	}
	

	
	/**
	 * Verify login
	 * @param string $lang
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
	 */
	public function login(Request $request){
		$rules =  [
					'email' =>'required',
					'password' => 'required'
				];

		$this->validate($request, $rules);
		$user = User::where('email', $request->email)
						->where('status', 1)->first();
		if($user !== null){
			if(Hash::check($request->password, $user->password)){
				return $this->showOne($user);
			}
			return $this->errorResponse('Wrong Password!', 423);
		}
		return $this->errorResponse('Email does not exist!', 442);
	}

}