<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodosResource;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TodoController extends Controller
{
    // get data to json
    public function getJsonAllTodos(Request $request)
    {
        $todos = Todo::where(function($q) {
            $q->where('delete_status', 0);
        })->orderby('name', 'ASC')->paginate($request->per_page??5);

        $todos = TodosResource::collection($todos)->response()->getData(true);

        $response = [
            'message' => 'Todo list retrieved successfully.',
            'statusCode' => 200,
            'data' => $todos['data'],
        ];

        return response()->json($response);
    }

    public function getJsonCategoryTodos(Request $request)
    {
        $todos = Todo::where(function($q) use($request){
            $q->where('delete_status', 0);
            $q->where('category_id', $request->category_id);
        })->orderby('name', 'ASC')->paginate($request->per_page??5);

        $todos = TodosResource::collection($todos)->response()->getData(true);

        $response = [
            'message' => 'Category Todo list retrieved successfully.',
            'statusCode' => 200,
            'data' => $todos['data'],
        ];

        return response()->json($response);
    }

    public function getJsonRecycleBin(Request $request)
    {
        $todo_categories = Todo::where(function($q) {
            $q->where('delete_status', 1);
        })->orderby('name', 'ASC')->paginate($request->per_page??5);
        $todo_categories = TodosResource::collection($todo_categories)->response()->getData(true);
        return response()->json([
            'message' => 'Deleted Tasks retrieved successfully.',
            'statusCode' => 200,
            'data' => $todo_categories['data'],
        ]);
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
    public function apiStore(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:0,1',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
            'user_id.required' => 'Please Insert User!',
            'category_id.required' => 'Please Seleted Category!',
            'status.required' => 'Status is required.',
            'status.in' => 'Status is invalid.',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) 
        {
		    return response()->json(['error'=>$validator->errors()], 401);
		}

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        $todo->user_id = intval($request->user_id);
        $todo->category_id = intval($request->category_id);
        $todo->status = intval($request->status);
        $todo->delete_status = 0;
        $todo->timestamps = false;
        $todo->created_by = intval($request->user_id);
        $todo->created_at = Carbon::now();
        $todo->save();

        $todo = new TodosResource($todo);

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

    public function apiEdit($id)
    {
        $todo = Todo::findorfail($id);
        $todo = new TodosResource($todo);
        $response = [
            'message' => 'Todo Edit successfully.',
            'statusCode' => 200,
            'data' => $todo
        ];
        return response($response);
    }

    // store todo
    public function update($id, Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
            'user_id.required' => 'Please Insert User!',
            'category_id.required' => 'Please Seleted Category!',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) 
        {
		    return response()->json(['error'=>$validator->errors()], 401);
		}

        $todo = Todo::find($id);
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        $todo->user_id = $request->user_id;
        $todo->category_id = $request->category_id;
        $todo->status = $request->status?1:0;
        $todo->timestamps = false;
        $todo->updated_by = intval($request->user_id);
        $todo->updated_at = Carbon::now();
        $todo->save();

        toast('success', 'Todo update successfully.');
        return redirect()->route('todos.index');
        // return response()->json($todo);
    }

    // store todo
    public function apiUpdate($id, Request $request)
    {
        $rules = array(
            'name' => 'required',
            'due_date' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'status' => 'required|in:0,1',
        );
        
        $messages = array(
            'name.required' => 'Please Task Name!',
            'due_date.required' => 'Please Select Due Date!',
            'user_id.required' => 'Please Insert User!',
            'category_id.required' => 'Please Seleted Category!',
            'status.required' => 'Status is required.',
            'status.in' => 'Status is invalid.',
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
        $todo->user_id = intval($request->user_id);
        $todo->category_id = intval($request->category_id);
        $todo->status = intval($request->status);
        $todo->timestamps = false;
        $todo->updated_by = intval($request->user_id);
        $todo->updated_at = Carbon::now();
        $todo->save();

        $todo = new TodosResource($todo);

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
    public function apiDelete(Request $request, $id)
    {
        $todo = Todo::findorfail($id);
        $todo->delete_status = 1;
        $todo->timestamps = false;
        $todo->deleted_by = intval($request->user_id);
        $todo->deleted_at = Carbon::now();
        $todo->save();

        $todo = new TodosResource($todo);

        $response = [
            'message' => 'Todo deleted successfully.',
            'statusCode' => 200,
            'data' => $todo
        ];
        return response($response);
    }
}
