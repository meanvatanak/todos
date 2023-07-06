<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
        /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
			if(Auth::check()){
				$act = Auth::user()->active;
				$del = Auth::user()->delete_status;
				

				if($act == 0 || $del == 1)
				{
					Session::flush();
					Auth::logout();
					toast('Oppes! You have entered invalid users!','error');
					return Redirect('login');
				}
				return redirect("dashboard");
			}
			return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
			return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
			$validator = Validator::make($request->all(), [
			'username' => 'required',
			'password' => 'required|min:8',
            
			]);
			if ($validator->fails()) {
				return redirect('login')
					->withInput()
					->withErrors($validator);
			}
			// $request->validate([
			//     'username' => 'required',
			//     'password' => 'required',
			// ]);
      $request['status'] = 1;
			$request['delete_status'] = 0;
			$credentials = $request->only('username', 'password', 'status','delete_status');
			if (Auth::attempt($credentials)) {
				$user = User::find(Auth::user()->id);
				$user->token = bin2hex(openssl_random_pseudo_bytes(30));
				$user->save();
				toast('You have Successfully loggedin!','success');
				return redirect()->intended('/dashboard');
			}
			toast('Oppes! You have entered invalid users!!!','error');
			return redirect("login");
    }

		public function login(Request $request)
    {
			$validator = Validator::make($request->all(), [
			'username' => 'required',
			'password' => 'required|min:8',
            
			]);
			if ($validator->fails()) {
				return response()->json(['error'=>$validator->errors()], 401);
			}
      $request['status'] = 1;
			$request['delete_status'] = 0;
			$credentials = $request->only('username', 'password', 'status','delete_status');
			if (Auth::attempt($credentials)) {
				$user = User::find(Auth::user()->id);
				$user->token = bin2hex(openssl_random_pseudo_bytes(30));
				$user->save();
				$response = [
					'user' => $user,
					'token' => $user->token
				];
				return response($response, 201);
			}
			return response()->json(['error'=>$validator->errors()], 401);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
			// $request->validate([
			// 	'username' => 'required',
			// 	'name' => 'required',
			// 	'email' => 'required|email',
			// 	'password' => 'required|min:8',
			// ]);

			$rules = array(
				'username' => 'required|unique:users,username,NULL,id,delete_status,0',
				'name' => 'required',
				'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9|unique:users,phone,NULL,id,delete_status,0',
				'email' => 'required|email',
				'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
				'password_confirmation' => 'required|min:8',
				// 'role_id' => 'required',
				'gender' => 'required',
				);
			$messages = array(
				'name.required' => 'Please insert candidate name!',
				'username.unique' => $request->username.' is already been taken!',
				'phone.required' => 'Please insert phone number!',
				'phone.unique' => $request->phone.' is already been taken!',
				'phone.not_regex' => 'Please insert number only in phone number field!',
				'email.required' => 'Please insert email!',
				'email.email' => 'Email is incorrect format!',
				// 'role_id.required' => 'Please Choose Role!',
				'gender.required' => 'Please Select Gender!',
			);

			$validator = Validator::make( $request->all(), $rules, $messages );
			if ($validator->fails()) {
				return back()
				->withInput()
				->withErrors($validator);
			}

			$theme = new ThemeSetting();
			$theme->theme = 'light';
			$theme->compact = 'condensed';
			$theme->timestamps = false;
			// $theme->created_by = Auth::id();
			$theme->created_at = Carbon::now();
			$theme->save();

			$user = New User;
			$user->name = $request->input('name');
			$user->gender = $request->input('gender');
			$user->username = $request->input('username');
			$user->phone = $request->input('phone');
			$user->email = $request->input('email');
			$user->address = $request->input('address');
			$user->role_id = 3;
			$user->theme_id = $theme->id;

			// if($request->file('image') != "")
			// {
			// 	$image = $request->file('image');
			// 	$upload = 'img/user/';
			// 	$filename = resizeImage($user->name,$image,$upload);
			// 	$user->image = $filename;
			// }
			
			$user->password = Hash::make($request->input('password'));
			
			$user->status = 0;
			$user->timestamps = false;
			// $user->created_by = Auth::id();
			$user->created_at = Carbon::now();
			$user->save();

			// $data = $request->all();
			// $user = $this->create($data);
			Auth::login($user);
			return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
			if(Auth::check()){
				$act = Auth::user()->status;
				$del = Auth::user()->delete_status;
				
				if($act == 0 || $del == 1)
				{
					Session::flush();
					Auth::logout();
					toast('Oppes! You have entered invalid users!','error');
					return Redirect('login');
				}
				return view('admin.index');
			}

			return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
			//remove token
			$user = User::find(Auth::user()->id);
			$user->token = null;
			$user->save();

			Session::flush();
			Auth::logout();

			return Redirect('login');
		}

		public function api_logout(){
			$user = User::find(Auth::user()->id);
			$user->token = null;
			$user->save();

			Session::flush();
			Auth::logout();

			return response()->json(['message' => 'Successfully logged out']);
		}
}
