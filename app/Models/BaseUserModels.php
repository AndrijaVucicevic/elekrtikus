<?php
/**
 * Created by PhpStorm.
 * User: Andrija
 * Date: 12/23/2020
 * Time: 9:57 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BaseUserModels
{


    public function create($data,$email_verified_at)
    {
        $role=1;
$time=time();

        $user=DB::table('users')
            ->insert([
             'name'=>$data['first_name'],
             'lastName'=>$data['lastName'],
             'email'=>$data['email'],
             'username'=>$data['username'],
             'password'=>Hash::make($data['password']),
             'role_id'=>$role,
              'created_at'=>$time,
                'email_verified_at'=>$email_verified_at
            ]);

return $user;

    }

    public function login($email)
    {
$jedan=0;
        $user=DB::table('users')
            ->select('id','name','lastName','password')
            ->where([
              [
                  'email',$email
              ],
              ['is_Active',$jedan]
           ] )
            ->orWhere([
                ['username',$email],
                ['is_Active',$jedan]
            ])
            ->first();

return $user;

    }

  public function userPassword($id)
  {
      return DB::table('users')
          ->select('password')
          ->where([
              ['is_Active','=','1'],
              ['id',$id]
          ])
          ->first();


  }

}