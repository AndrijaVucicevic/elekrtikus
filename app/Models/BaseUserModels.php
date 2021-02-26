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

    public $name;
    public $lastName;
    public $email;
    public $username;
    public $passNew;

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
$one=1;
        $user=DB::table('users')
            ->select('id','name','lastName','password')
            ->where([
              [
                  'email',$email
              ],
              ['is_Active',$one]
           ] )
            ->orWhere([
                ['username',$email],
                ['is_Active',$one]
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
  public function getUser($id)
  {
      return DB::table('users')
          ->select('name','username','lastName','email','role_name',
              DB::raw("date_format(from_unixtime(created_at),'%b %d, %Y %l:%i %p') as created_at")
          )
          ->join('roles','users.role_id','=','roles.id_role')
          ->where('id',$id)
          ->first();


  }
  public function changeUser($id)
  {
      $code=201;
      try{

          DB::table('user')
              ->where('id',$id)
              ->update([
                 'name'=>$this->name,
                  'lastName'=>$this->lastName,
                  'email'=>$this->email,
                  'username'=>$this->username,
                  'updated_at'=>time()
              ]);


      }
      catch(\Throwable $e) {
          //\Log::critical("Failed to insert youur ad.");
          $code=$e->getMessage();
          //  throw new \Exception("Greska pri unosu");

      }
      return $code;
  }
public function changePasswordUser($id,$password)
{
    $code=201;
    try{

        DB::table('user')
            ->where('id',$id)
            ->update([
                'password'=>Hash::make($password),
                'updated_at'=>time()
            ]);


    }
    catch(\Throwable $e) {
        //\Log::critical("Failed to insert youur ad.");
        $code=$e->getMessage();
        //  throw new \Exception("Greska pri unosu");

    }
    return $code;


}



}