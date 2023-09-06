<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\PublisherHostory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PublisherController extends Controller
{
    public function getDataTable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

        $model = Publisher::query()
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
				{ $action .=' <a class="text-primary show_detail" href="publisher/' . $row['id'] . '/show" data-id="' . $row['id'] . '"><i class="fas fa-eye"></i></a>'; }
				if($nav['optEdit'] != 0)
				{ $action .=' <a class="text-primary edit" href="publisher/' . $row['id'] . '/edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></a>'; }
                if($nav['optDelete'] != 0)
				{ $action .=' <a class="text-danger delete-confirm" href="publisher/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>'; }
				return  $action; 
			})
			->rawColumns(['action'])
        ->make(true);
	}

    public function publishers(Request $request)
    {
        if(!$request->ajax()) { return back(); }
        $data = Publisher::where([
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
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optView'] != 1)
        { return response()->json($data = 'No Permission!'); }
        

        return view('e-library-publisher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcreate()
    {
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optCreate'] != 1)
        { return response()->json($data = 'No Permission!'); }

        return view('e-library-publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optCreate'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $publisher = new Publisher();
        $publisher->name = $request->name_publisher;
        
        $publisher->status = $request->has('status')?1:0;
        $publisher->delete_status = 0;
		$publisher->timestamps = false;
		$publisher->created_by = Auth::id();
		$publisher->created_at = Carbon::now();
		$publisher->save();

        $publisher_history = new PublisherHostory();
        $publisher_history->publisher_id = $publisher->id;
        $publisher_history->name = $publisher->name;
        $publisher_history->status = $publisher->status;
        $publisher_history->delete_status = $publisher->delete_status;
        $publisher_history->timestamps = false;
        $publisher_history->created_by = $publisher->created_byed->employee->name;
        $publisher_history->created_at = $publisher->created_at;
        $publisher_history->save();

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
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optShow'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $publisher = Publisher::findorfail($id);

        return view('e-library-publisher.show')
                ->with('publisher', $publisher);
    }

    public function show_history(Request $request)
    {
        if (!$request->ajax()) 
		{ return back(); }

        $model = PublisherHostory::query()
            ->where(function ($q) use($request){
                $q->where('publisher_id', $request->publisher_id);
        })
        ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[74];

		return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('branch', function (PublisherHostory $model) {
                return $model->branch_id ? $model->branch->name : '-';
            })
            ->addColumn('created_bys', function (PublisherHostory $model) {
                return $model->created_by ? $model->created_by : '';
            })
            ->addColumn('updated_bys', function (PublisherHostory $model) {
                return $model->updated_by ? $model->updated_by : '';
            })
            ->addColumn('date_time', function (PublisherHostory $model) {
                if($model->created_at)
                { return date('d-M-Y H:s A', strtotime($model->created_at)); }
                elseif($model->updated_at)
                { return date('d-M-Y H:s A', strtotime($model->updated_at)); }
                elseif($model->deleted_at)
                { return date('d-M-Y H:s A', strtotime($model->deleted_at)); }
            })
            ->addColumn('action', function($row){
                $action = '';
                $action = '<a class="text-primary btn-show show_detail" href="/publisher/'. $row['id'] .'/history"><i
                                class="fas fa-eye"></i></a>';
                return  $action;
            })
			->rawColumns(['action'])
        ->make(true);
    }

    public function show_history_detail($id)
    {
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optShow'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $publisher_history = PublisherHostory::findorfail($id);

        return view('e-library-publisher.show_detail')
                ->with('publisher_history',$publisher_history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optEdit'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $publisher = Publisher::findorfail($request->id);

        return view('e-library-publisher.edit')
                ->with('publisher', $publisher);
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

        $publisher = Publisher::findorfail($request->id);
        $publisher->name = $request->name_publisher;
        
        $publisher->status = $request->has('status')?1:0;
        $publisher->delete_status = 0;
		$publisher->timestamps = false;
		$publisher->updated_by = Auth::id();
		$publisher->updated_at = Carbon::now();
		$publisher->save();

        $publisher_history = new PublisherHostory();
        $publisher_history->publisher_id = $publisher->id;
        $publisher_history->name = $publisher->name;
        $publisher_history->status = $publisher->status;
        $publisher_history->delete_status = $publisher->delete_status;
        $publisher_history->timestamps = false;
        $publisher_history->updated_by = $publisher->updated_byed->employee->name;
        $publisher_history->updated_at = $publisher->updated_at;
        $publisher_history->save();

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
        if(!isset(session('permissions')[73]) || session('permissions')[73]['optDelete'] != 1)
        { return response()->json($data = 'No Permission!'); }

        $publisher = Publisher::findorfail($request->id);
        $publisher->delete_status = 1;
		$publisher->timestamps = false;
		$publisher->deleted_by = Auth::id();
		$publisher->deleted_at = Carbon::now();
		$publisher->save();

        $publisher_history = new PublisherHostory();
        $publisher_history->publisher_id = $publisher->id;
        $publisher_history->name = $publisher->name;
        $publisher_history->status = $publisher->status;
        $publisher_history->delete_status = $publisher->delete_status;
        $publisher_history->timestamps = false;
        $publisher_history->deleted_by = $publisher->deleted_byed->employee->name;
        $publisher_history->deleted_at = $publisher->deleted_at;
        $publisher_history->save();

        toast('Publisher has been deleted!','success');
        return redirect('publisher');
    }
}
