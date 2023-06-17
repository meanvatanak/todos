<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
	public function getDataTable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

		$model = Role::query()
		->where([
			['delete_status' , '=', 0],
			['id' , '!=', 1],
			])
		->orderBy('id', 'DESC')->get();

		if($request->name)
		{
			$matchthese = [
				['name' , 'LIKE', '%'.$request->name.'%'],
				['delete_status' , '=', 0],
				['id' , '!=', 1],
			];
			$model = Role::query()
			->where($matchthese)
			->orderBy('id', 'DESC')->get();
		}

		$nav = session('permissions')[0];

		return DataTables::of($model)
			->addIndexColumn()
			->addColumn('action', function($row) use ($nav){
				$action = '';
				// $action .=' <a class="text-primary" href="role/' . $row['id'] . '/view"><i class="far fa-eye"></i></a>';
				if($nav['optEdit'] != 0)
				{ $action .=' <a class="text-primary" href="role/' . $row['id'] . '/edit"><i class="fas fa-edit"></i></a>'; }
				// $action .=' <a class="text-primary" href="role/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>';
				return  $action; 
			})
			->rawColumns(['action'])
			->make(true);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if(!isset(session('permissions')[0]) || session('permissions')[0]['optView'] == 0)
		{ return back(); }

		return view('role.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		if(!isset(session('permissions')[0]) || session('permissions')[0]['optCreate'] == 0)
		{ return back(); }

		$labels = Label::orderBy('id', 'ASC')->get();

		return view('role.create')
		->with('labels', $labels);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(!isset(session('permissions')[0]) || session('permissions')[0]['optCreate'] == 0)
		{ return back(); }

		$rules = array(
			'role_name' => 'required|max:30|min:3|unique:roles,role_name',
		);
		$messages = array(
			'name.required' => 'Please insert role name!',
			'name.unique' => $request->name.' is already been created!',
		);

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) {
		return back()
			->withInput()
			->withErrors($validator);
		}

		// Create The Role
		$role = new Role();
		$role->role_name = $request->Input('role_name');
		$role->remark = $request->Input('remark');

		$role->status = $request->has('status')?1:0;
		$role->timestamps = false;
		$role->created_by = Auth::id();
		$role->created_at = Carbon::now();
		$role->save();

		$labels = Label::orderBy('id', 'ASC')->get();

		foreach($labels as $label)
		{
			$permission = new Permission();
			$header = array("headerPermission","headerAdministrator");
			if($label->header == "Permission")
			{ $permission->header = $request->has('headerPermission')?"Permission":0; }
			elseif($label->header == "Website")
			{ $permission->header = $request->has('headerWebsite')?"Website":0; }
			// elseif($label->header == "Administrator")
			// { $permission->header = $request->has($header[4])?"Administrator":0; }
			
			$page = "page$label->name";
			$permission->name = $request->has($page)?$label->name:"0_".$label->name;

			$view = "view$label->name";
			$permission->optView = $request->has($view)?1:0;

			$permission->role_id = $role->id;

			$create = "create$label->name";
			$permission->optCreate = $request->has($create)?1:0;

			$show = "show$label->name";
			$permission->optShow = $request->has($show)?1:0;

			$edit = "edit$label->name";
			$permission->optEdit = $request->has($edit)?1:0;

			$delete = "delete$label->name";
			$permission->optDelete = $request->has($delete)?1:0;

			$permission->timestamps = false;
			$permission->save();

		}

		toast('Role has been created!','success');
		return redirect('/role');
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
		if(!isset(session('permissions')[0]) || session('permissions')[0]['optEdit'] == 0)
		{ return back(); }

		if($id == 1)
		{ return back(); }

		$labels = Label::orderBy('id', 'ASC')->get();
		// $labels_name = Label::all()->pluck('name')->toArray();

		$role = Role::findOrFail($id);
		// $permissions = Permission::where('role_id', $role->id)->get();
		checkNewPermission($id);
		
		$permissions = Permission::where('role_id', $role->id)->get();
		return view('role.edit')
		->with('role', $role)
		->with('labels', $labels)
		->with('permissions',$permissions);
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
		if(!isset(session('permissions')[0]) || session('permissions')[0]['optEdit'] == 0)
		{ return back(); }

		$role = Role::findorfail($id);
		if($role->role_name == $request->role_name)
		{
			$rules = array(
				'role_name' => 'required|max:30|min:3',
			);
		}
		else
		{
			$rules = array(
				'role_name' => 'required|max:30|min:3|unique:roles,role_name',
			);
		}
		
		$messages = array(
			'name.required' => 'Please insert role name!',
			'name.unique' => $request->name.' is already been created!',
		);

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) {
			return back()
				->withInput()
				->withErrors($validator);
		}

		// Update Role
						
		$role->role_name = $request->Input('role_name');
		$role->remark = $request->Input('remark');

		$role->status = $request->has('status')?1:0;
		$role->timestamps = false;
		$role->updated_by = Auth::id();
		$role->updated_at = Carbon::now();
		$role->save();

		// Update Permission
		$labels = Label::orderBy('id', 'ASC')->get();
		foreach($labels as $label)
		{
			$permission = Permission::where([
				['name', '=', $label->name],
				['role_id', '=', $id],
			])
			->orWhere([
				['name', '=', "0_".$label->name],
				['role_id', '=', $id],
			])->first();

			if(isset($permission))
			{
				if($label->header == "Permission")
				{ $permission->header = $request->has("headerPermission")?"Permission":0; }
				elseif($label->header == "Website")
				{ $permission->header = $request->has("headerWebsite")?"Website":0; }
				$permission->role_id = $id;
				$permission->name = $request->has("page".$label->name)?$label->name:"0_".$label->name;

				$view = "view$label->name";
				$permission->optView = $request->has($view)?1:0;
				$create = "create$label->name";
				$permission->optCreate = $request->has($create)?1:0;
				$show = "show$label->name";
				$permission->optShow = $request->has($show)?1:0;
				$edit = "edit$label->name";
				$permission->optEdit = $request->has($edit)?1:0;
				$delete = "delete$label->name";
				$permission->optDelete = $request->has($delete)?1:0;

				$permission->timestamps = false;
				$permission->save();
			}
		}

		toast('Role has been updated!','success');
		return redirect('/role');
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
