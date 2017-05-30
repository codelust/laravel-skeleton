<?php

namespace Frontiernxt\Helpers;

use Illuminate\Http\Request;

class AuthHelper
{
    
    public function __construct(Request $request)
    {

    	$this->request = $request;
    }

    public function hasJWTToken()
    {

    	$has_token = false;

		$authorization_header = $this->request->header('authorization');

		$authorization_var =  $this->request->input('token', null);

		if ($authorization_header && !empty($authorization_header))
		{
			//$has_token = true;
		}

		if ($authorization_var)
		{

			$has_token = true;
		}



		return $has_token;


    }

    public function haltOnNoJWTToken()
    {


    	if (!self::hasJWTToken())
    	{
    		//dd(self::hasJWTToken());

    		//return response()->json(['error' => 'no token found'])->send();

    		exit(json_encode(['error' => 'no token found']));
    	} 

    	return true;

    }
}
