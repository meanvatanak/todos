<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoCategoryResource;
use App\Models\TodoCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class TodoCategoryController extends Controller
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

    public function getJsonTodoCategories(Request $request)
    {
        $todo_categories = TodoCategory::where(function($q) {
            $q->where('delete_status', 0);
        })->orderby('name', 'ASC')->paginate($request->per_page??5);
        $todo_categories = TodoCategoryResource::collection($todo_categories)->response()->getData(true);
        return response()->json([
            'message' => 'todoCategories retrieved successfully.',
            'statusCode' => 200,
            'data' => $todo_categories['data'],
        ]);
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

    public function apiStore(Request $request)
    {
        $rules = array(
			'name' => [
                'required',
                Rule::unique('todo_categories')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name)
                                 ->where('user_id', $request->user_id)
                                 ->where('delete_status', 0);
                })
            ],
		);

        $messages = array(
            'name.required' => 'Name is required.',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
        if ($validator->fails()) {
            return response()->json(['message'=> $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }

        $todo_category = new TodoCategory();
        $todo_category->name = $request->name;
        $todo_category->user_id = intval($request->user_id);
        $todo_category->status = intval($request->status);
        $todo_category->delete_status = 0;
        $todo_category->timestamps = false;
        $todo_category->created_by = intval($request->user_id);
        $todo_category->created_at = Carbon::now();
        $todo_category->save();

        $todo_category = new TodoCategoryResource($todo_category);

        return response()->json([
            'message' => 'todoCategory created successfully.',
            'statusCode' => 200,
            'data' => $todo_category,
        ]);
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
        //
    }

    public function apiEdit(Request $request, $id)
    {
        $todo_category = TodoCategory::find($id);

        $todo_category = new TodoCategoryResource($todo_category);

        return response()->json([
            'message' => 'todoCategory retrieved successfully.',
            'statusCode' => 200,
            'data' => $todo_category,
        ]);
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
        //
    }

    public function apiUpdate(Request $request, $id)
    {
        $rules = array(
			'name' => [
                'required',
                Rule::unique('todo_categories')->where(function ($query) use ($request, $id) {
                    return $query->where('name', $request->name)
                                 ->where('id','!=', $id)
                                 ->where('user_id', $request->user_id)
                                 ->where('delete_status', 0);
                })
            ],
		);

        $messages = array(
            'name.required' => 'Name is required.',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) {
		return back()
			->withInput()
			->withErrors($validator);
		}

        $todo_category = TodoCategory::find($id);
        $todo_category->name = $request->name;
        $todo_category->user_id = intval($request->user_id);
        $todo_category->status = intval($request->status);
        $todo_category->timestamps = false;
        $todo_category->updated_by = intval($request->user_id);
        $todo_category->updated_at = Carbon::now();
        $todo_category->save();

        $todo_category = new TodoCategoryResource($todo_category);

        return response()->json([
            'message' => 'todoCategory updated successfully.',
            'statusCode' => 200,
            'data' => $todo_category,
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
        //
    }

    public function apiDelete(Request $request, $id)
    {
        $todo_category = TodoCategory::find($id);
        $todo_category->user_id = intval($request->user_id);
        $todo_category->delete_status = 1;
        $todo_category->timestamps = false;
        $todo_category->deleted_by = intval($request->user_id);
        $todo_category->deleted_at = Carbon::now();
        $todo_category->save();

        $todo_category = new TodoCategoryResource($todo_category);

        return response()->json([
            'message' => 'todoCategory updated successfully.',
            'statusCode' => 200,
            'data' => $todo_category,
        ]);
        
    }
}
