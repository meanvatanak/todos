<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Models\UserHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	public function api_user()
	{
		$model = User::query()
		->where(function($query){
			$query->where('status', 1);
			$query->where('delete_status', 0);
		})
		->orderBy('id', 'DESC')->get();

		return response()->json($model);
	}

	public function history($id)
	{
			$model = UserHistory::findorfail($id);

			return view('user.history')
							->with('user_history', $model);
	}

	public function HistoryGetDatatable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

		$model = UserHistory::query()
		->where([
			['user_id', $request->user_id],
		])
		->orderBy('id', 'DESC')->get();

		if($request->name)
		{
			$matchthese = [
				['name' , 'LIKE', '%'.$request->name.'%'],
				['user_id', $request->user_id],
			];
			$model = UserHistory::query()
			->where($matchthese)
			->orderBy('id', 'DESC')->get();
		}

		if($request->phone)
		{
			$matchthese = [
				['phone' , 'LIKE', '%'.$request->phone.'%'],
				['user_id', $request->user_id],
			];
			$model = UserHistory::query()
			->where($matchthese)
			->orderBy('id', 'DESC')->get();
		}

		// $nav = session('permissions')[1];

		return DataTables::of($model)
			->addIndexColumn()
			->addColumn('created_name', function (UserHistory $model) {
				return $model->created_by ? $model->created_name->name : '-';
			})
			->addColumn('updated_name', function (UserHistory $model) {
				return $model->updated_by ? $model->updated_name->name: '-';
			})
			->addColumn('deleted_name', function (UserHistory $model) {
				return $model->deleted_by ? $model->deleted_name->name : '-';
			})
			->addColumn('action', function($row){
				$action = '';
				$action .=' <a class="text-primary btn-show" href="'.url('user/'.$row['id'].'/history').'"><i class="far fa-eye"></i></a>';
				return  $action; 
			})
			->rawColumns(['action','created_name','updated_name'])
			->make(true);

	}

    public function getDataTable(Request $request)
    {
			if (!$request->ajax()) 
			{ return back(); }

			$model = User::query()
			->where( function($q) use($request){

				if($request->name) 
				{ $q->where('name', 'like', '%' . $request->name . '%'); }

				if($request->phone) 
				{ $q->where('phone', 'like', '%' . $request->phone . '%'); }

				$q->where('delete_status', 0);
				$q->where('id', '!=', 1);
			})
			->orderBy('id', 'DESC')->get();

			$nav = session('permissions')[1];

			return DataTables::of($model)
				->addIndexColumn()
				->addColumn('role', function (User $model) {
						return $model->role_id ? $model->role->role_name : '-';
				})
				->addColumn('action', function($row) 	use ($nav){
					$action = '';
					if($nav['optShow'] != 0)
					{ $action .=' <a class="text-primary" href="user/' . $row['id'] . '/show"><i class="far fa-eye"></i></a>'; }
					if($nav['optEdit'] != 0)
					{ $action .=' <a class="text-primary" href="user/' . $row['id'] . '/edit"><i class="fas fa-edit"></i></a>'; }
					if($nav['optDelete'] != 0)
					{ $action .=' <a class="text-danger delete-confirm" href="user/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>'; }
					return  $action; 
				})
				->rawColumns(['action','role'])
				->make(true);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optView'] == 0)
			{ return back(); }

    	return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optCreate'] == 0)
			{ return back(); }

			$roles = Role::where([
				['delete_status','=',0],
				['status','=',1],
			])->get();

			return view('user.create')->with('roles',$roles);
    }

    public function baseRoleUser()
    {
			$data = Role::where([
				['delete_status','=',0],
				['status','=',1],
			])->get();
			return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optCreate'] == 0)
			{ return back(); }

			// Create The User
			// $user = User::firstOrNew(array('username' => $request->username));
			
			$rules = array(
				'username' => 'required|unique:users,username,NULL,id,delete_status,0',
				'name' => 'required',
				'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9|unique:users,phone,NULL,id,delete_status,0',
				'email' => 'required|email',
				'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
				'password_confirmation' => 'required|min:8',
				'role_id' => 'required',
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
				'role_id.required' => 'Please Choose Role!',
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
			$theme->created_by = Auth::id();
			$theme->created_at = Carbon::now();
			

			//Create New User
			$username = User::where([
				['username', $request->username],
				['delete_status', 1]
			])->first();
			$userphone = User::where([
				['phone', $request->phone],
				['delete_status', 1]
			])->first();

			if(isset($username))
			{ 
				$user = User::where([
					['username', $request->username],
					['delete_status', 1]
				])->first();
				$user->delete_status = 0;
			}
			elseif(isset($userphone))
			{
				$user = User::where([
					['phone', $request->phone],
					['delete_status', 1]
				])->first();
				$user->delete_status = 0;
			}
			else
			{ $user = New User; }
			$theme->save();
			$user->name = $request->input('name');
			$user->gender = $request->input('gender');
			$user->username = $request->input('username');
			$user->phone = $request->input('phone');
			$user->email = $request->input('email');
			$user->address = $request->input('address');
			$user->role_id = $request->input('role_id');
			$user->theme_id = $theme->id;

			if($request->file('image') != "")
			{
				$image = $request->file('image');
				$upload = 'img/user/';
				$filename = resizeImage($user->name,$image,$upload);
				$user->image = $filename;
			}
			
			$user->password = Hash::make($request->input('password'));
			
			$user->status = $request->has('status')?1:0;
			$user->timestamps = false;
			$user->created_by = Auth::id();
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
			$user_history->delete_status = 1;

			$user_history->timestamps = false;
			$user_history->created_by = $user->created_by;
			$user_history->created_at = $user->created_at;
			$user_history->save();
			
			toast('User has been created!','success');
			return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optShow'] == 0)
			{ return back(); }

			$user = User::findorfail($id);
			$user_history = UserHistory::where([
				['user_id',$id]
			])->get();

      return view('user.show')
			->with('user',$user)
			->with('user_history',$user_history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optEdit'] == 0)
			{ return back(); }

			$user = User::findorfail($id);

			return view('user.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optEdit'] == 0)
			{ return back(); }
			
			if($request->input('password') != '')
			{
				$rules = array(
					'username' => 'required|unique:users,username,'. $request->username.',id,username,',
					'name' => 'required',
					'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
					'email' => 'required|email',
					'role_id' => 'required',
					'gender' => 'required',
					'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
					'password_confirmation' => 'required|min:8',
				);
			}
			else
			{
				$rules = array(
					'username' => 'required|unique:users,username,'. $request->username.',id,username,',
					'name' => 'required',
					'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
					'email' => 'required|email',
					'role_id' => 'required',
					'gender' => 'required',
				);
			}
			
			$messages = array(
				'name.required' => 'Please insert name!',
				'username.required' => 'Please insert username!',
				'username.unique' => $request->username.' is already been taken!',
				'phone.required' => 'Please insert phone number!',
				'phone.not_regex' => 'Please insert number only in phone number field!',
				'email.required' => 'Please insert email!',
				'email.email' => 'Email is incorrect format!',
				'role_id.required' => 'Please Choose Role!',
				'gender.required' => 'Please Select Gender!',
			);
			$validator = Validator::make( $request->all(), $rules, $messages );
			if ($validator->fails()) 
			{
				return back()
					->withInput()
					->withErrors($validator);
			}
        
			// update The User
			$user = User::findorfail($id);
			// $user = User::FirstOrNew($id);
			$user->name = $request->input('name');
			$user->gender = $request->input('gender');
			$user->username = $request->input('username');
			$user->phone = $request->input('phone');
			$user->email = $request->input('email');
			$user->address = $request->input('address');
			$user->role_id = $request->input('role_id');

			if($request->file('image') != "")
			{
				$image = $request->file('image');
				$upload = 'img/user/';
				// if(isset($user->image))
				// { unlink($upload.$user->image); }
				$filename = resizeImage($user->name,$image,$upload);
				$user->image = $filename;
			}
			
			if($request->input('password') != '')
			{ $user->password = Hash::make($request->input('password')); }
			
			$user->status = $request->has('status')?1:0;
			$user->timestamps = false;
			$user->updated_by = Auth::id();
			$user->updated_at = Carbon::now();
			$user->save();

			$user_history = New UserHistory();
			$user_history->user_id = $user->id;
			$user_history->username = $user->username;
			if($request->input('password') != '')
			{ $user_history->password = 'Has been changed'; }
			else
			{ $user_history->password = 'Has not been changed'; }
			$user_history->phone = $user->phone;
			$user_history->gender = $user->gender;
			$user_history->image = $user->image;
			$user_history->email = $user->email;
			$user_history->name = $user->name;
			$user_history->address = $user->address;
			$user_history->role = $user->role->role_name;

			$user_history->status = $user->status;
			$user_history->delete_status = $user->delete_status;

			$user_history->timestamps = false;
			$user_history->updated_by = $user->updated_by;
			$user_history->updated_at = $user->updated_at;
			$user_history->save();

			toast('User has been updated!','success');
			return redirect('/user');
    }

		public function updateProfile(Request $request, $id)
		{
			$rules = array(
				'name' => 'required',
				'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
				'gender' => 'required',
				'email' => 'required|email',
				'address' => 'required',
			);

			$messages = array(
				'name.required' => 'Please insert name!',
				'phone.required' => 'Please insert phone number!',
				'phone.not_regex' => 'Please insert number only in phone number field!',
				'gender.required' => 'Please select gender!',
				'email.required' => 'Please insert email!',
				'address.required' => 'Please insert address!',
			);
			$validator = Validator::make( $request->all(), $rules, $messages );
			if ($validator->fails()) {
				return response([
					'message' => 'Validation Error',
					'statusCode' => Response::HTTP_UNAUTHORIZED,
					'errors' => $validator->errors(),
				], Response::HTTP_UNAUTHORIZED);
			}

			$user = User::findorfail($id);
			$user->name = $request->name;
			$user->phone = $request->phone;
			$user->gender = $request->gender;
			$user->email = $request->email;
			$user->address = $request->address;
			$user->timestamps = false;
			$user->updated_by = $id;
			$user->updated_at = Carbon::now();
			$user->save();

			$user_history = New UserHistory();
			$user_history->user_id = $user->id;
			$user_history->username = $user->username;
			if($request->input('password') != '')
			{ $user_history->password = 'Has been changed'; }
			else
			{ $user_history->password = 'Has not been changed'; }
			$user_history->phone = $user->phone;
			$user_history->gender = $user->gender;
			$user_history->image = $user->image;
			$user_history->email = $user->email;
			$user_history->name = $user->name;
			$user_history->address = $user->address;
			$user_history->role = $user->role->role_name;

			$user_history->status = $user->status;
			$user_history->delete_status = $user->delete_status;

			$user_history->timestamps = false;
			$user_history->updated_by = $user->updated_by;
			$user_history->updated_at = $user->updated_at;
			$user_history->save();

			return response()->json([
					// 'meta' => [
					//     'current_page' => $ebooks['meta']['current_page'],
					//     'last_page' => $ebooks['meta']['last_page'],
					//     'total' => $ebooks['meta']['total'],
					//     'from' => $ebooks['meta']['from'],
					//     'to' => $ebooks['meta']['to'],
					// ],
					'message' => 'E-Book.',
					'statusCode' => 200,
					'data' => $user,
			]);
		}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			if(!isset(session('permissions')[1]) || session('permissions')[1]['optDelete'] == 0)
			{ 
				toast('You are not allowed to delete!','error');
				return back(); 
			}

			$user = User::findorfail($id);
			// $upload = 'img/user/';
			// if(isset($user->image))
			// { unlink($upload.$user->image); }
			$user->delete_status = 1;
			$user->save();

			$user_history = New UserHistory();
			$user_history->user_id = $user->id;
			$user_history->username = $user->username;
			$user_history->password = 'Has not been changed';
			$user_history->phone = $user->phone;
			$user_history->gender = $user->gender;
			$user_history->image = $user->image;
			$user_history->email = $user->email;
			$user_history->name = $user->name;
			$user_history->address = $user->address;
			$user_history->role = $user->role->role_name;

			$user_history->status = $user->status;
			$user_history->delete_status = $user->delete_status;

			$user_history->timestamps = false;
			$user_history->deleted_by = $user->deleted_by;
			$user_history->deleted_at = $user->deleted_at;
			$user_history->save();
			
			toast('User has been deleted!','success');
			return redirect('/user');
    }
}
