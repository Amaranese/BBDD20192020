<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //header('Access-Control-Allow-Origin: *');
        if (empty($request->name) || empty($request->password) || empty($request->email)) {
            return response()->json([
                'MESSAGE' => 'Some fields are null'], 400
            );
        } else {
            $user = new User();
            $user->name = str_replace(' ', '', $request->name);
            $repeatedEmail = User::where('email', $request->email)->first();
            if ($repeatedEmail != true) {
                if (!strpos($request->email, "@") || !strpos($request->email, ".")) 
                {
                    return response()->json([
                        'MESSAGE' => 'The email has not been written correctly'], 406
                    );
                } else{
                    $user->email = $request->email;
                }
            }else{
                return response()->json([
                    'MESSAGE' => 'The email is in use'], 400
                );
            }
            if (strlen($request->password) > 7)
            {
                $user->password = encrypt($request->password);
            } else 
            {
                return response()->json([
                    'MESSAGE' => 'The password must have more than seven characters'], 400
                );
            }
            $user->role_id = 2;
            $user->save();
            $tokenParams = [
                'id' => $user->id,
                'password' => $_POST['password'],
                'email' => $_POST['email'],
            ];
            $token = JWT::encode($tokenParams, $this->key);
            return response()->json([
                'MESSAGE' => $token, 'The user has been created correctly'], 200
            );
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
