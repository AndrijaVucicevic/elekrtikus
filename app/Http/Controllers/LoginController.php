<?php

namespace App\Http\Controllers;

use App\Models\BaseUserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\Javascript;

class LoginController extends Controller
{
    //
    private $model;


    public function __construct()
    {
        //  parent::__call($method, $parameters); // TODO: Change the autogenerated stub
        $this->model= new BaseUserModels();
    }



    public function login(Request $request)
    {

     $email=$request->name;
     $password=$request->password;



        $findme   = '@';
        $pos = strpos($email, $findme);
        if($pos==false)
        {

            $validator = Validator::make($request->all(), [
                 'name'=> ['required', 'max:20','regex:/^[\w\.\_\d]{6,17}$/'],
                'password' => ['required', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[.!@#$%^&*])(?=.{8,})/'],
            ]);


        }
        else{


            $validator = Validator::make($request->all(), [

                'name' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[.!@#$%^&*])(?=.{8,})/'],
            ]);

        }

if ($validator->passes()) {
    $user = $this->model->login($email);
   $errors=[];
    if ($user) {
        if (Hash::check($password, $user->password)) {
            Auth::loginUsingId($user->id);

        } else {


            array_push($errors,'Zaboravili ste sifru?');
            return response()->json(['error'=>$errors]);
        }

    } else {
          array_push($errors,'Nepostojeće korisničko ime');
           return response()->json(['error'=>$errors]);
    }


}
        return response()->json(['error'=>$validator->errors()->all()]);



    }

    public function logout(Request $request)
    {

       // $model->updateOnline(auth()->user()->id,$jedan=0);
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }




}
