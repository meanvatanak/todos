<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AuthorController extends Controller
{
    public function getDataTable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

        $model = Author::query()
            ->where(function ($q) {

            if (request()->name) 
            { $q->where('name', 'like', '%' . request()->name . '%'); }

            $q->where('delete_status', '=', 0);
        })
        ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[72];

		return DataTables::of($model)
			->addIndexColumn()
			->addColumn('action', function($row) use($nav){
				$action = '';
                if($nav['optShow'] != 0)
				{ $action .=' <a class="text-primary show_detail" href="author/' . $row['id'] . '/show" data-id="' . $row['id'] . '"><i class="fas fa-eye"></i></a>'; }
				if($nav['optEdit'] != 0)
				{ $action .=' <a class="text-primary edit" href="author/' . $row['id'] . '/edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></a>'; }
                if($nav['optDelete'] != 0)
				{ $action .=' <a class="text-danger delete-confirm" href="author/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>'; }
				return  $action; 
			})
			->rawColumns(['action'])
        ->make(true);
	}

    public function authors(Request $request)
    {
        if(!$request->ajax()) { return back(); }
        $data = Author::where([
            ['status', '=', 1],
            ['delete_status', '=', 0],
        ])->get();
        return response()->json($data);
    }    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optView'] != 1)
        { return response()->json($data = 'No Permission!'); }
        

        return view('e-library-author.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcreate()
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optCreate'] != 1)
        { return response()->json($data = 'No Permission!'); }

        return view('e-library-author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optCreate'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $author = new Author();
        $author->name = $request->name_author;
        
        $author->status = $request->has('status')?1:0;
        $author->delete_status = 0;
		$author->timestamps = false;
		$author->created_by = Auth::id();
		$author->created_at = Carbon::now();
		$author->save();

        $author_history = new AuthorHistory();
        $author_history->author_id = $author->id;
        $author_history->name = $author->name;
        $author_history->status = $author->status;
        $author_history->delete_status = $author->delete_status;
        $author_history->timestamps = false;
        $author_history->created_by = $author->created_byed->employee->name;
        $author_history->created_at = $author->created_at;
        $author_history->save();

		return response()->json('Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optShow'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $author = Author::findorfail($id);

        return view('e-library-author.show')
                ->with('author', $author);
    }

    public function show_history(Request $request)
    {
        if (!$request->ajax()) 
		{ return back(); }

        $model = AuthorHistory::query()
            ->where(function ($q) use($request){
                $q->where('author_id', $request->author_id);
        })
        ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[72];

		return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('branch', function (AuthorHistory $event_history) {
                return $event_history->branch_id ? $event_history->branch->name : '-';
            })
            ->addColumn('created_bys', function (AuthorHistory $event_history) {
                return $event_history->created_by ? $event_history->created_by : '';
            })
            ->addColumn('updated_bys', function (AuthorHistory $event_history) {
                return $event_history->updated_by ? $event_history->updated_by : '';
            })
            ->addColumn('date_time', function (AuthorHistory $event_history) {
                if($event_history->created_at)
                { return date('d-M-Y H:s A', strtotime($event_history->created_at)); }
                elseif($event_history->updated_at)
                { return date('d-M-Y H:s A', strtotime($event_history->updated_at)); }
                elseif($event_history->deleted_at)
                { return date('d-M-Y H:s A', strtotime($event_history->deleted_at)); }
            })
            ->addColumn('action', function($row){
                $action = '';
                $action = '<a class="text-primary btn-show show_detail" href="/author/'. $row['id'] .'/history"><i
                                class="fas fa-eye"></i></a>';
                return  $action;
            })
			->rawColumns(['action'])
        ->make(true);
    }

    public function show_history_detail($id)
    {
        if(!isset(session('permissions')[71]) || session('permissions')[71]['optShow'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $author_history = AuthorHistory::findorfail($id);

        return view('e-library-author.show_detail')
                ->with('author_history',$author_history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optEdit'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $author = Author::findorfail($request->id);

        return view('e-library-author.edit')
                ->with('author', $author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optEdit'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $author = Author::findorfail($request->id);
        $author->name = $request->name_author;
        
        $author->status = $request->has('status')?1:0;
        $author->delete_status = 0;
		$author->timestamps = false;
		$author->updated_by = Auth::id();
		$author->updated_at = Carbon::now();
		$author->save();

        $author_history = new AuthorHistory();
        $author_history->author_id = $author->id;
        $author_history->name = $author->name;
        $author_history->status = $author->status;
        $author_history->delete_status = $author->delete_status;
        $author_history->timestamps = false;
        $author_history->updated_by = $author->updated_byed->employee->name;
        $author_history->updated_at = $author->updated_at;
        $author_history->save();

        return response()->json('Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!isset(session('permissions')[72]) || session('permissions')[72]['optDelete'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $author = Author::findorfail($request->id);
        $author->delete_status = 1;
		$author->timestamps = false;
		$author->deleted_by = Auth::id();
		$author->deleted_at = Carbon::now();
		$author->save();

        $author_history = new AuthorHistory();
        $author_history->author_id = $author->id;
        $author_history->name = $author->name;
        $author_history->status = $author->status;
        $author_history->delete_status = $author->delete_status;
        $author_history->timestamps = false;
        $author_history->deleted_by = $author->deleted_byed->employee->name;
        $author_history->deleted_at = $author->deleted_at;
        $author_history->save();

        toast('Author has been deleted!','success');
        return redirect('author');
    }
}
