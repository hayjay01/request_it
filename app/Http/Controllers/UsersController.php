<?php

namespace App\Http\Controllers;

use App\User; //to use this class on this page
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Mail\welcome_message;


/**
function longest(str){
    var words = String(str).replace(/[^A-Za-z0-9\s]/g, "").split(" ");
    var wordsByDescendingLength = words.sort(function(a, b) {
        return b.length - a.length;
    });
    return wordsByDescendingLength[0];
}
*/
use Auth;
class UsersController extends Controller
{
    public function dashboard()
    
    {
        return view('users.dashboard');
    }
    
    public function getStarted()
    
    {
    	return view('users.index');
    }


    public function getSignup()
    {
    	return view('users.signup');
    }

    public function postSignup(Request $request)

    {
    	$this->validate($request, [
    		'email' => 'email|required|unique:users', 
    		'password' => 'required|min:4'
    	]);
    	
    	$user = new User(['email' => $request->input('email'), //collecting email in input field to an assoc array
    		'password' => $request->input('password') //hashing d pass
    	]);

    	$user->save();
        Auth::login($user);
    	return redirect()->route('users.view_request');
    }

    public function Signin(Request $request)
        {
            $method = $request->isMethod('post');
            // dd($method);
            switch ($method) {
                case true:
                        $this->validate($request, [
                            'email' => 'email|required',
                            'password' => 'required|min:4'
                        ]);
                        $authenticate_user = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
                        if ($authenticate_user) {
                            //i.e if email n password match using d auth class
                            //basically, attempt function under class Auth or Auth facade method collects all parameters i.e all input fields tovalidate in an associative array inform of key and valuefrm above, the key is the field or column declared fillable in the user model
                            return redirect()->route('users.view_request');
                        }else{
                            return redirect()->route('users.signup')->with(['signup_error_message' => 'Look like you dont have an account yet, Signup below!']);            
                        }    
                break;
                case false:
                    return view('users.signin');    
                break;
                default:
                    return view('users.signin');    
                break;
            }
        }

    Public function Signup(Request $request)
        {
            $method = $request->isMethod('post');
            switch ($method) {
                case 'post':
                        $this->validate($request, [
                            'email' => 'email|required|unique:users', 
                            'password' => 'required|min:4', 
                            'department' => 'required',
                            'gender' => 'required'
                            ]);
                $user = new User([

                  'email' => $request->input('email'),
                  'password' => Hash::make($request->input('password')),
                  'department' => $request->input('department'),
                  'gender' => $request->input('gender')

                  ]);
                        $user->save();
                        Auth::login($user);
                        // \Mail::to($user)->send(new welcome_message($user));
                        return redirect()->route('users.view_request')->with(['message'=>'Welcometo request it enjoy life to the fullest!']);
                break;
                case 'get':
                    return redirect()->route('users.signup')->with(['message'=>'Signup to proceed']);
                    break;
                default:
                    return view('users.signup')->with(['message'=>'Signup to proceed']);
                break;
            }
        } //end of Signup


    public function getRequest(){
        $current_user_mail = Auth::user()->email;
        // dd($current_user_mail); exit;
        compact($current_user_mail);
    	return view('users.request' , ['current_user_mail' => $current_user_mail]);
    }  

    public function Signout(){
        Auth::logout();
        return redirect()->route('index');
    }


    public function editProfile(Request $request)
    {
        $method = $request->isMethod('post');
            switch ($method) {
              case true:
                      $this->validate($request, [
                            'user_image' => 'required',
                            'username' =>'required'
                          ]);
                         $current_user_full_details = Auth::user();
                            //accept the file from user using file method
                         $file = $request->file('user_image');
                            //get original name and path of image
                         $file_name = $file->getClientOriginalName();
                         //move file from source to destination
                         $file->move("images/", $file_name);

                         //dk
                         $current_user_full_details->username = $request->input('username');
                         $current_user_full_details->user_image = $file_name;
                         $current_user_full_details->update();
                         compact($current_user_full_details->user_image);
                         // dd($current_user_full_details->user_image); exit;
                          return view('users.edit', ['current_user_image' => $current_user_full_details->user_image, 'current_username' => $current_user_full_details->username])->with(['message' => 'Request Successfully Updated']);
                    break;
                    case false:
                      // dd($validator);
                         $user_password = Auth::user()->password;
                         $user_email = Auth::user()->email;
                         $current_user_full_details = Auth::user()->user_image;
                         $current_username = Auth::user()->username;

                         // dd($current_user_full_details); exit;
                         compact($current_user_full_details);
                        return view('users.edit', ['current_user_image' => $current_user_full_details,  'current_username' => $current_username, 'user_email' => $user_email, 'user_password' => $user_password]);
                    break;
                    default:
                         $current_user_full_details = Auth::user()->user_image;
                         // dd($current_user_full_details); exit;
                         compact($current_user_full_details);
                        return view('users.edit', ['current_user_image' => 'hello']);
                        
                    break;
            }
    }

    public function forgotPassword(Request $request)
    {
      $method = $request->isMethod('post');

      switch ($method) {
        case true:
            $this->validate($request, ['email' => 'required']);
            $checkUserExist = DB::table('users')->get(['email']);
            dd($checkUserExist);

          break;
        case false:
            return view('users.forgot_password');
          break;
        default:
            return view('users.forgot_password');
        break;
      }

    }

    public function view_all_user()
    {
     
      // dd($users); exit;
      return redirect()->route('users.view_request');
    }
    
} //end of class UsersController
