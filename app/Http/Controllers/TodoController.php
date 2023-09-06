<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TodoController extends Controller
{
    // get data to json
    public function getJson()
    {
        // dd(Auth::user()->role);
        $todos = Todo::orderby('id', 'DESC')->get();
        $response = [
            'message' => 'Todo list.',
            'statusCode' => 200,
            'data' => $todos
        ];
        return response()->json($response);
    }

    // index of todo
    public function index()
    {
        // if(!isset(session('permissions')[1]) || session('permissions')[1]['optCreate'] == 0)
        // { return back(); }

        return view('todos.index');
    }

    // get datatable
    public function getDatatable(Request $request)
    {
			if (!$request->ajax()) 
			{ return back(); }

			$model = Todo::query()
            ->where(function ($q) use($request) {
                if ($request->name) 
                { $q->where('name', 'like', '%' . $request->name . '%'); }
            })
			->orderBy('id', 'DESC')->get();

			return DataTables::of($model)
				->addIndexColumn()
                ->addColumn('user', function($row){
                    return $row->user_id ? $row->user->name : '-';
                })
				->addColumn('action', function($row){
					$action = '';
					$action .=' <a class="text-primary" href="todos/' . $row['id'] . '/edit"><i class="fas fa-edit"></i></a>';
					$action .=' <a class="text-danger delete-confirm" href="todos/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>';
					return  $action; 
				})
				->rawColumns(['action'])
				->make(true);

    }

    // create todo
    public function create()
    {
        return view('todos.create');
    }

    // store todo
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) 
        {
		    return back()
                ->withInput()
                ->withErrors($validator);
		}

        // $todo = new Todo();
        // $todo->name = $request->name;
        // $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        // $todo->description = $request->description;
        // $todo->status = $request->status?1:0;
        // $todo->timestamps = false;
        // $todo->save();

        $todo = Todo::create([
                'name' => $request->name,
                'due_date' => date('Y-m-d', strtotime($request->due_date)),
                'description' => $request->description,
                'status' => $request->status?1:0,
                'user_id' => auth()->user()->id,
        ]);

        toast('success', 'Todo created successfully.');
        return redirect()->route('todos.index');
        // $data = [
        //     'statusCode' => 201,
        //     'message' => 'Todo created successfully.',
        //     'data' => $todo
        // ];

        // return response()->json($todo);
    }

    // store todo
    public function store_api(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
            'user_id' => 'required',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
            'user_id.required' => 'Please Insert User!',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) 
        {
		    return response()->json(['error'=>$validator->errors()], 401);
		}

        // $todo = new Todo();
        // $todo->name = $request->name;
        // $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        // $todo->description = $request->description;
        // $todo->status = $request->status?1:0;
        // $todo->timestamps = false;
        // $todo->save();

        $todo = Todo::create([
                'name' => $request->name,
                'due_date' => date('Y-m-d', strtotime($request->due_date)),
                'description' => $request->description,
                'status' => $request->status?1:0,
                'user_id' => $request->user_id,
        ]);

        $response = [
            'message' =>  'Todo created successfully.',
            'statusCode' => 200,
            'data' => $todo
        ];

        return response($response);
    }

    // edit todo
    public function edit($id)
    {
        $todo = Todo::findorfail($id);
        return view('todos.edit')
                    ->with('todo', $todo);
    }

    // store todo
    public function update($id, Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) 
        {
		    return back()
                ->withInput()
                ->withErrors($validator);
		}

        $todo = Todo::findorfail($id);
        $todo->name = $request->name;
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        $todo->description = $request->description;
        $todo->user_id = auth()->user()->id;
        $todo->status = $request->status?1:0;
        $todo->timestamps = false;
        $todo->save();

        toast('success', 'Todo update successfully.');
        return redirect()->route('todos.index');
        // return response()->json($todo);
    }

    // store todo
    public function update_api($id, Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) 
        {
		    return response()->json(['error'=>$validator->errors()], 401);
		}

        $todo = Todo::findorfail($id);
        $todo->name = $request->name;
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        $todo->description = $request->description;
        $todo->user_id = $request->user_id;
        $todo->status = $request->status?1:0;
        $todo->timestamps = false;
        $todo->save();

        $response = [
            'message' => 'Todo update successfully.',
            'statusCode' => 200,
            'data' => $todo
        ];
        return response($response);
    }

    // delete todo
    public function destroy($id)
    {
        $todo = Todo::findorfail($id);
        $todo->delete();

        toast('success', 'Todo deleted successfully.');
        return redirect()->route('todos.index');
        // return response()->json($todo);
    }

    // delete todo
    public function destroy_api($id)
    {
        $todo = Todo::findorfail($id);
        $todo->delete();

        $response = [
            'message' => 'Todo deleted successfully.',
            'statusCode' => 200,
        ];

        // toast('success', 'Todo deleted successfully.');
        // return redirect()->route('todos.index');
        // return response()->json($response);
        return response($response);
    }
}
