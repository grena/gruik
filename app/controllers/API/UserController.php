<?php namespace API;

use \Input;

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $userRepo = \App::make('Gruik\Repo\User\UserInterface');

        $user = $userRepo->byId($id);

        if($user && $user->id == \Sentry::getUser()->id)
        {
        	$inputs = Input::all();

            // Password change
        	$new_password = array_pull($inputs, 'new_password', false);
        	$new_password_conf = array_pull($inputs, 'new_password_conf', false);

            $user = $user->fill($inputs);

        	if($new_password && $new_password_conf && $new_password == $new_password_conf)
        	{
        		$user->password = $new_password;
        	}

            $user->save();

            return \Response::json($user, 200);
        }
        else
        {
            return \Response::json("Unauthorized : User doesn't exist OR you can't modify it", 400);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
