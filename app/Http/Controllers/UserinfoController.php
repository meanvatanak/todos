<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserHistory;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserinfoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $user_id = Auth::user()->id;
        if($user_id != $id)
        { return back(); }

        $user = User::findOrFail($id);
        $erorroldpassword = '';
        return view('userinfo.user')
        ->with('user', $user)->with('erorroldpassword',$erorroldpassword);
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
        $user_id = Auth::user()->id;
        if($user_id != $id)
        { return back(); }
        
        $user = User::find($id);

        if($request->input('password') != '')
        {
            $rules = array(
                'username' => 'required|unique:users,username,'. $request->username.',id,username,',
                'name' => 'required',
                // 'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
                'email' => 'required|email',
                'gender' => 'required',
                'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required|min:8',
                'oldpassword' => ['required', new MatchOldPassword],
                );
        }
        else
        {
            $rules = array(
                'username' => 'required|unique:users,username,'. $request->username.',id,username,',
                'name' => 'required',
                // 'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
                'email' => 'required|email',
                'gender' => 'required',
                );
        }
        $messages = array(
            'username.required' => 'Please insert username!',
            'oldpassword.required' => 'Please enter old password!',
            'oldpassword.MatchOldPassword' => 'Old Pass!',
            'password.required' => 'Please insert new password!',
            'password_confirmation.required' => 'Please insert new confirmation password!',
            
            'name.required' => 'Please insert name!',
            'username.unique' => $request->username.' is already been taken!',
            'phone.required' => 'Please insert phone number!',
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
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required|max:30|min:1',
        //     'oldpassword' => ['required', new MatchOldPassword],
        //     'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
        //     'password_confirmation' => 'required|min:8',
        // ]);
        // $erorroldpassword = '';

        if ($validator->fails()) {
			return back()
				->withInput()
				->withErrors($validator);
		}

		// Update User
		$user = User::find($id);

        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        // $user->username = $request->input('username');
        // $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        // $user->role_id = $request->input('role_id');

        if($request->file('image') != "")
        {
            $image = $request->file('image');
            $upload = 'img/user/';
            if(isset($user->image))
            { unlink($upload.$user->image); }
            $filename = resizeImage($user->name,$image,$upload);
            $user->image = $filename;
		}

        if($request->input('password') != '')
        { $user->password = Hash::make($request->input('password')); }
        
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
        
        toast('Your password has been updated!','success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
