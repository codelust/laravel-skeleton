<?php

namespace Frontiernxt\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Frontiernxt\Models\User;
use Frontiernxt\Helpers\AuthHelper;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{

	/*Create a new user*/

	public function store(Request $request)
	{
		
		/*Run the validators*/

		$validator = Validator::make($request->all(), [
            'first_name' => 'required',
        	'password' => 'required|min:8',
        	'email' => 'required|email|unique:users'
        ]);

        /*
		@todo: needs to wrap this in a proper error format
        */

        if ($validator->fails()) {
            
            return response()->api_error($validator->messages());
        

        } else {

        	if( $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'name' => $request->get('first_name').' '.$request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        	])){

    		$response_data = ['username' => $user->name, 'email' => $user->email, 'id' => $user->id];

    		return response()->api_success($response_data);
        	}
        }

	}

	public function authenticate(Request $request)
	{			


		$credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        //return response()->api_success(compact('token'));

        $user = User::where('email', '=', $request->get('email'))->first();

        //$currentUser = JWTAuth::parseToken()->authenticate();

        //$currentUser = Auth::validate($request->only('email', 'password'));

        //dd($currentUser);

        $response_data = ['username' => $user->name, 'email' => $user->email, 'id' => $user->id, 'token' => $token];

        return response()->api_success($response_data);
	}


	public function user(Request $request)
	{	

		$token = JWTAuth::getToken();
	    

		//dd($token);

		$auth_check = new AuthHelper($request);

		$has_token = $auth_check->haltOnNoJWTToken();
			
		try{

			$currentUser = JWTAuth::parseToken()->authenticate();

		} catch (Exception $e) {
			
			return response()->json(['error' => 'no token found']);
		}


		//$currentUser = JWTAuth::parseToken();

		dd($currentUser);
	}


		public function test(Request $request)
	{

		//return 'haha';
		return \Frontiernxt\Models\User::all();
	}
}