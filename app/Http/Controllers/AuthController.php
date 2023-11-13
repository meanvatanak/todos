<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use App\Models\User;
use App\Models\Permission;
use App\Models\UserHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

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
				checkNewPermission(Auth::user()->role_id);
				session()->put('roles', Auth::user()->role->toArray());
				session()->put('permissions', Permission::where('role_id', Auth::user()->role_id)->get()->toArray());
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
				return response()->json(['error'=>$validator->errors()], Response::HTTP_UNAUTHORIZED);
			}
      $request['status'] = 1;
			$request['delete_status'] = 0;
			$credentials = $request->only('username', 'password', 'status','delete_status');

			if(!Auth::attempt($credentials)) {
				return response([
					'message' => 'Invalid Credentials!'
				], Response::HTTP_UNAUTHORIZED);
			}

			// if (Auth::attempt($credentials)) {
			// 	$user = User::find(Auth::user()->id);
			// 	$user->token = $user->createToken('token')->plainTextToken;
			// 	$user->save();
			// 	$response = [
			// 		'message' => 'You have Successfully loggedin!',
			// 		'statusCode' => 200,
			// 		'data' => $user,
			// 	];
			// 	return response($response);
			// }
			// return response()->json(['error'=>$validator->errors()], 401);

			$user = User::find(Auth::user()->id);
			$user->token = $user->createToken('token')->plainTextToken;
			$user->save();

			$response = [
				'message' => 'You have Successfully loggedin!',
				'statusCode' => 200,
				'user' => $user,
			];
			return response(
				$response,
				Response::HTTP_OK
			);
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

		public function api_register(Request $request)
		{
			$rules = array(
				'full_name' => 'required',
				'phone' => [
						'required',
						'regex:/(0)[0-9]/',
						'not_regex:/[a-z]/',
						'min:9',
						Rule::unique('users')->where(function ($query) use ($request) {
								return $query->where('phone', $request->phone)
														->where('delete_status', 0);
						})
				],
				'gender' => 'required',
				'email' =>  [
					'required',
					'email',
					Rule::unique('users')->where(function ($query) use ($request) {
							return $query->where('email', $request->email)
													->where('delete_status', 0);
					})
				],
				'address' => 'required',
				'username' => [
					'required',
					Rule::unique('users')->where(function ($query) use ($request) {
							return $query->where('username', $request->username)
													->where('delete_status', 0);
					})
				],
				'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
			);

			$messages = array(
				'full_name.required' => 'Please insert candidate name!',
				'phone.required' => 'Please insert phone number!',
				'phone.unique' => $request->phone.' is already been taken!',
				'phone.not_regex' => 'Please insert number only in phone number field!',
				'gender.required' => 'Please select gender',
				'email.required' => 'Please insert email!',
				'address.required' => 'Please insert address!',
				'username.required' => 'Please insert username!',
				'username.unique' => $request->username.' is already been taken!',
				'password.required' => 'Please insert password!',
				'password_confirmation.required' => 'Please insert confirm password!',
				'password_confirmation.same' => 'Password and confirm password not match!',
			);

			$validator = Validator::make( $request->all(), $rules, $messages );
			if ($validator->fails()) {
				return response()->json(['message'=> $validator->errors()], Response::HTTP_UNAUTHORIZED);
			}

			$theme = new ThemeSetting();
			$theme->theme = 'light';
			$theme->compact = 'condensed';
			$theme->timestamps = false;
			// $theme->created_by = Auth::id();
			$theme->created_at = Carbon::now();

			//Create New User
			$user = New User;
			$theme->save();
			$user->name = $request->full_name;
			$user->phone = $request->phone;
			$user->gender = $request->gender;
			$user->email = $request->email;
			$user->address = $request->address;
			$user->role_id = 3;
			$user->username = $request->username;
			$user->theme_id = $theme->id;
			
			$user->password = Hash::make($request->input('password'));
			
			$user->status = 1;
			$user->timestamps = false;
			$user->created_at = Carbon::now();
			$user->save();

			$user_history = New UserHistory();
			$user_history->user_id = $user->id;
			$user_history->username = $user->username;
			$user_history->password = 'Created';
			$user_history->phone = $user->phone;
			$user_history->gender = $user->gender;
			$user_history->image = $user->image;
			$user_history->email = $user->email;
			$user_history->name = $user->name;
			$user_history->address = $user->address;
			$user_history->role = $user->role->role_name;

			$user_history->status = $user->status;
			$user_history->delete_status = 0;

			$user_history->timestamps = false;
			$user_history->created_by = 'API_Register';
			$user_history->created_at = $user->created_at;
			$user_history->save();

			$response = [
				'message' => 'You have Successfully registered!',
				'statusCode' => 200,
				'user' => $user,
			];

			return response(
				$response,
				Response::HTTP_OK
			);

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

		public function api_logout(Request $request){

			$user = User::find($request->user_id);
			$token = $request->bearerToken();
			
			if($token){
				$token_id = find_string_before_pipe($token);
				PersonalAccessToken::findorfail($token_id)->delete();
			}

			$user->token = null;
			$user->save();

			Session::flush();
			Auth::logout();

			$response = [
				'message' => 'You have Successfully loggedout!',
				'statusCode' => 200,
			];
			return response($response);
		}
}
