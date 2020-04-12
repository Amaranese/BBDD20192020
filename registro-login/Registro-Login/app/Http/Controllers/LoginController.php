<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
class LoginController extends Controller
{
    const USER = 0;
    const PASSWORD = 1;
    public function login()
    {
    	$key = '4vQzqA11LEp9iHInFTArCchWk6eXFUKuVXNT7yMNjEnL1ihEDJpRirTb888QhBs0';
    	$userDB = [
    		self::USER => 'alejandro', 
    		self::PASSWORD => 'm@3Bge%M[oH7Z3}rL0J2'
    	];
    	if ($userDB[self::USER] == $_POST['user'] and $userDB[self::PASSWORD] == $_POST['password']) 
    	{
    		
    		$tokenParams = [
    			'user' => $userDB[self::USER],
    			'password' => $userDB[self::PASSWORD],
    			'random' => time()
    		];
    		$token = JWT::encode($tokenParams, $key);
    		return response()->json([
	            'token' => $token,
	        ]);
    	}
    	
    }
}
