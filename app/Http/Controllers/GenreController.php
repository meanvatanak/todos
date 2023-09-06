<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\GenreHostory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GenreController extends Controller
{
    public function getDataTable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

        $model = Genre::query()
            ->where(function ($q) {

            if (request()->name) 
            { $q->where('name', 'like', '%' . request()->name . '%'); }

            $q->where('delete_status', '=', 0);
        })
        ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[74];

		return DataTables::of($model)
			->addIndexColumn()
			->addColumn('action', function($row) use($nav){
				$action = '';
                if($nav['optShow'] != 0)
				{ $action .=' <a class="text-primary show_detail" href="genre/' . $row['id'] . '/show" data-id="' . $row['id'] . '"><i class="fas fa-eye"></i></a>'; }
				if($nav['optEdit'] != 0)
				{ $action .=' <a class="text-primary edit" href="genre/' . $row['id'] . '/edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></a>'; }
                if($nav['optDelete'] != 0)
				{ $action .=' <a class="text-danger delete-confirm" href="genre/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>'; }
				return  $action; 
			})
			->rawColumns(['action'])
        ->make(true);
	}

    public function genres(Request $request)
    {
        if(!$request->ajax()) { return back(); }
        $data = Genre::where([
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
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optView'] != 1)
        { return response()->json($data = 'No Permission!'); }
        

        return view('e-library-genre.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcreate()
    {
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optCreate'] != 1)
        { return response()->json($data = 'No Permission!'); }

        return view('e-library-genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optCreate'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $genre = new Genre();
        $genre->name = $request->name_genre;
        
        $genre->status = $request->has('status')?1:0;
        $genre->delete_status = 0;
		$genre->timestamps = false;
		$genre->created_by = Auth::id();
		$genre->created_at = Carbon::now();
		$genre->save();

        $genre_history = new GenreHostory();
        $genre_history->genre_id = $genre->id;
        $genre_history->name = $genre->name;
        $genre_history->status = $genre->status;
        $genre_history->delete_status = $genre->delete_status;
        $genre_history->timestamps = false;
        $genre_history->created_by = $genre->created_byed->employee->name;
        $genre_history->created_at = $genre->created_at;
        $genre_history->save();

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
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optShow'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $genre = Genre::findorfail($id);

        return view('e-library-genre.show')
                ->with('genre', $genre);
    }

    public function show_history(Request $request)
    {
        if (!$request->ajax()) 
		{ return back(); }

        $model = GenreHostory::query()
            ->where(function ($q) use($request){
                $q->where('genre_id', $request->genre_id);
        })
        ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[74];

		return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('branch', function (GenreHostory $event_history) {
                return $event_history->branch_id ? $event_history->branch->name : '-';
            })
            ->addColumn('created_bys', function (GenreHostory $event_history) {
                return $event_history->created_by ? $event_history->created_by : '';
            })
            ->addColumn('updated_bys', function (GenreHostory $event_history) {
                return $event_history->updated_by ? $event_history->updated_by : '';
            })
            ->addColumn('date_time', function (GenreHostory $event_history) {
                if($event_history->created_at)
                { return date('d-M-Y H:s A', strtotime($event_history->created_at)); }
                elseif($event_history->updated_at)
                { return date('d-M-Y H:s A', strtotime($event_history->updated_at)); }
                elseif($event_history->deleted_at)
                { return date('d-M-Y H:s A', strtotime($event_history->deleted_at)); }
            })
            ->addColumn('action', function($row){
                $action = '';
                $action = '<a class="text-primary btn-show show_detail" href="/genre/'. $row['id'] .'/history"><i
                                class="fas fa-eye"></i></a>';
                return  $action;
            })
			->rawColumns(['action'])
        ->make(true);
    }

    public function show_history_detail($id)
    {
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optShow'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $genre_history = GenreHostory::findorfail($id);

        return view('e-library-genre.show_detail')
                ->with('genre_history',$genre_history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optEdit'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $genre = Genre::findorfail($request->id);

        return view('e-library-genre.edit')
                ->with('genre', $genre);
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
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optEdit'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $genre = Genre::findorfail($request->id);
        $genre->name = $request->name_genre;
        
        $genre->status = $request->has('status')?1:0;
        $genre->delete_status = 0;
		$genre->timestamps = false;
		$genre->updated_by = Auth::id();
		$genre->updated_at = Carbon::now();
		$genre->save();

        $genre_history = new GenreHostory();
        $genre_history->genre_id = $genre->id;
        $genre_history->name = $genre->name;
        $genre_history->status = $genre->status;
        $genre_history->delete_status = $genre->delete_status;
        $genre_history->timestamps = false;
        $genre_history->updated_by = $genre->updated_byed->employee->name;
        $genre_history->updated_at = $genre->updated_at;
        $genre_history->save();

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
        if(!isset(session('permissions')[74]) || session('permissions')[74]['optDelete'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $genre = Genre::findorfail($request->id);
        $genre->delete_status = 1;
		$genre->timestamps = false;
		$genre->deleted_by = Auth::id();
		$genre->deleted_at = Carbon::now();
		$genre->save();

        $genre_history = new GenreHostory();
        $genre_history->genre_id = $genre->id;
        $genre_history->name = $genre->name;
        $genre_history->status = $genre->status;
        $genre_history->delete_status = $genre->delete_status;
        $genre_history->timestamps = false;
        $genre_history->deleted_by = $genre->deleted_byed->employee->name;
        $genre_history->deleted_at = $genre->deleted_at;
        $genre_history->save();

        toast('Genre has been deleted!','success');
        return redirect('genre');
    }
}
