<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TodoController extends Controller
{
    // get data to json
    public function getJson()
    {
        $todos = Todo::orderby('id', 'DESC')->get();
        return response()->json($todos);
    }

    // index of todo
    public function index()
    {
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

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->due_date = date('Y-m-d', strtotime($request->due_date));
        $todo->description = $request->description;
        $todo->status = $request->status?1:0;
        $todo->timestamps = false;
        $todo->save();

        toast('success', 'Todo created successfully.');
        return redirect()->route('todos.index');
        // return response()->json($todo);
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
        $todo->status = $request->status?1:0;
        $todo->timestamps = false;
        $todo->save();

        toast('success', 'Todo update successfully.');
        return redirect()->route('todos.index');
        // return response()->json($todo);
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
}
