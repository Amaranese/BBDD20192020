<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
class LoginController extends Controller
{
    const USER = 0;
    const PASSWORD = 1;
    public function register()
    {
    	$key = 'QorDdQi1J0CyXKd635Xoft41fEBEbLQ7J1lipTlYKGQ9fiZsxmDueyvrdVAXplyc';
    	$userDB = [
    		self::USER => 'alejandro', 
    		self::PASSWORD => 'q1Mfue~6-qrg}-FrPSc*'
    	];
    	if ($userDB[self::USER] == $_POST['user'] and $userDB[self::PASSWORD] == $_POST['password']) 
    	{
    		
    		$tokenParams = [
    			'user' => $userDB[self::USER],
                'email' => $userDB[self:: EMAIL],
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