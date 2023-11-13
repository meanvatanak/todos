<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\ELibrary;
use App\Models\ElibraryFavorite;
use App\Models\ELibraryHistory;
use App\Models\Genre;
use App\Models\Publisher;
use App\Http\Resources\ElibraryResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\ParentElibraryResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ELibraryController extends Controller
{

    public function getJsonEbook(Request $request) 
    {
        // dd(Auth::user()->role);
        $ebooks = ELibrary::orderby('id', 'DESC')->paginate($request->per_page??5);
        
        $ebooks = ElibraryResource::collection($ebooks)->response()->getData(true);
        
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
            'data' => $ebooks['data'],
        ]);
    }

    public function getJsonPopularEbook(Request $request)
    {
        // dd(Auth::user()->role);
        $ebooks = ELibrary::where(function($q) {
            $q->where('view', '>=', 15);
        })
        ->orderby('view', 'ASC')
        ->paginate($request->per_page??5);
        $ebooks = ElibraryResource::collection($ebooks)->response()->getData(true);
        $response = [
            'message' => 'Popular E-Book.',
            'statusCode' => 200,
            'data' => $ebooks['data']
        ];
        return response()->json($response);
    }

    public function getJsonNewEbook()
    {
        // dd(Auth::user()->role);
        $ebooks = ELibrary::where(function($q) {
            $q->where('year', '>=', 2010);
        })->orderby('year', 'ASC')->get();
        $ebooks = ElibraryResource::collection($ebooks);
        $response = [
            'message' => 'E-Book.',
            'statusCode' => 200,
            'data' => $ebooks
        ];
        return response()->json($response);
    }

    public function getJsonUploadEbook()
    {
        // dd(Auth::user()->role);
        // order elibrary by created at desc and only 10 row
        $ebooks = ELibrary::orderby('created_at', 'DESC')->take(10)->get();

        $ebooks = ElibraryResource::collection($ebooks);

        $response = [
            'message' => 'E-Book.',
            'statusCode' => 200,
            'data' => $ebooks
        ];
        return response()->json($response);
    }

    public function api_read($id)
    {
        // find ebook by ID with author name, publisher name, genre name
        $ebook = ELibrary::findorfail($id);
        $ebook->view = $ebook->view + 1;
        $ebook->save();
        $ebook = new ElibraryResource($ebook);        

        $response = [
            'message' => 'E-Book.',
            'statusCode' => 200,
            'data' => $ebook
        ];
        return response()->json($response);
    }

    public function api_favorite(Request $request)
    {

        //validate if user already favorite the ebook
        $ebookFavorite = ElibraryFavorite::where([
            ['user_id', '=', $request->user_id],
            ['elibrary_id', '=', $request->elibrary_id],
            ['delete_status', '=', 0],
        ])->first();

        if($ebookFavorite)
        {
            $ebookFavorite->delete();

            $response = [
                'message' => 'E-Book.',
                'statusCode' => 200,
                'data' => $ebookFavorite
            ];
            return response()->json($response);
        }

        $ebook = ELibrary::findorfail($request->elibrary_id);

        $ebookFavorite = new ElibraryFavorite();
        $ebookFavorite->user_id = $request->user_id;
        $ebookFavorite->elibrary_id = $request->elibrary_id;
        $ebookFavorite->status = 1;
        $ebookFavorite->delete_status = 0;
        $ebookFavorite->timestamps = false;
        $ebookFavorite->save();

        $response = [
            'message' => 'E-Book.',
            'statusCode' => 200,
            'data' => $ebook
        ];
        return response()->json($response);
    }

    public function get_favorite(Request $request)
    {
        //get elibrary and inner join with elibrary favorite
        // $ebookFavorite = ELibrary::join('elibrary_favorites', 'elibrary_favorites.elibrary_id', '=', 'e_libraries.id')
        //             ->where('elibrary_favorites.user_id', $request->user_id)
        //             ->orderby('e_libraries.id', 'DESC')
        //             ->select(
        //                 "e_libraries.id as id",
        //                 "e_libraries.title as title",
        //                 "e_libraries.year as year",
        //                 "e_libraries.page as page",
        //                 "e_libraries.author_id as author_id",
        //                 "e_libraries.publisher_id as publisher_id",
        //                 "e_libraries.genre_id as genre_id",
        //                 "e_libraries.book_cover as book_cover",
        //                 "e_libraries.book_file as book_file",
        //                 "e_libraries.view as view",
        //             )
        //             ->distinct()
        //             ->get();
        
        $ebookFavorite = ELibraryFavorite::where(function ($q) use($request){
            $q->where('user_id', $request->user_id);
            $q->where('delete_status', 0);
        })
        ->groupBy('elibrary_id')
        ->orderby('elibrary_id', 'DESC')
        ->paginate($request->per_page??5);

        $ebookFavorite = ParentElibraryResource::collection($ebookFavorite)->response()->getData(true);

        return response()->json([
            'message' => 'success',
            'statusCode' => 200,
            'data' => $ebookFavorite['data'],
        ]);
    }

    public function getJsonAuthor(Request $request)
    {
        // dd(Auth::user()->role);
        $authors = Author::orderby('name', 'ASC')
        ->paginate($request->per_page??5);
        $authors = AuthorResource::collection($authors)->response()->getData(true);
        return response()->json([
            'message' => 'Author',
            'statusCode' => 200,
            'data' => $authors['data'],
        ]);
    }

    public function get_books_by_author(Request $request)
    {
        $ebooks = ELibrary::where(function($q) use($request) {
            $q->where('author_id', '=', $request->author_id);
        })->orderby('id', 'DESC')->paginate($request->per_page??5);

        $ebooks = ElibraryResource::collection($ebooks)->response()->getData(true);

        $response = [
            'message' => 'E-Book.',
            'statusCode' => 200,
            'data' => $ebooks['data']
        ];
        return response()->json($response);
    }

    public function getJsonGenre(Request $request)
    {
        // dd(Auth::user()->role);
        $genres = Genre::orderby('name', 'ASC')
        ->paginate($request->per_page??5);
        $genres = GenreResource::collection($genres)->response()->getData(true);
        return response()->json([
            'message' => 'Genre',
            'statusCode' => 200,
            'data' => $genres['data'],
        ]);
    }

    public function getBooksByGenre(Request $request)
    {
        $ebooks = ELibrary::where(function($q) use($request) {
            $q->where('genre_id', '=', $request->genre_id);
        })->orderby('id', 'DESC')->paginate($request->per_page??5);

        $ebooks = ElibraryResource::collection($ebooks)->response()->getData(true);

        $response = [
            'message' => 'E-Book.',
            'statusCode' => 200,
            'data' => $ebooks['data']
        ];
        return response()->json($response);
    }


    public function getDataTable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

		$model = ELibrary::query()
                    ->where(function ($q) use($request){

                    if ($request->title) 
                    { $q->where('title', 'like', '%' . $request->title . '%'); }

                    if ($request->year) 
                    { $q->where('year', 'like', '%'.$request->year.'%'); }

                    if ($request->page) 
                    { $q->where('page', 'like', '%'.$request->page.'%'); }

                    if ($request->author_id) 
                    { $q->where('author_id', $request->author_id); }
                    if ($request->publisher_id	) 
                    { $q->where('publisher_id', $request->publisher_id); }
                    if ($request->genre_id) 
                    { $q->where('genre_id', $request->genre_id); }
                    
                    $q->where('delete_status', 0);
                })
                ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[75];

		return DataTables::of($model)
			->addIndexColumn()
            ->addColumn('author', function (ELibrary $model) {
                return $model->author_id ? $model->author->name : '-';
            })
            ->addColumn('publisher', function (ELibrary $model) {
                return $model->publisher_id ? $model->publisher->name : '-';
            })
            ->addColumn('genre', function (ELibrary $model) {
                return $model->genre_id ? $model->genre->name : '-';
            })
			->addColumn('action', function($row) use($nav) {
				$action = '';
                if($nav['optShow'] != 0)
				{ $action .=' <a class="text-primary" href="e-library/' . $row['id'] . '/show"><i class="fas fa-eye"></i></a>'; }
				if($nav['optEdit'] != 0)
				{ $action .=' <a class="text-primary" href="e-library/' . $row['id'] . '/edit"><i class="fas fa-edit"></i></a>'; }
                if($nav['optDelete'] != 0)
				{ $action .=' <a class="text-danger delete-confirm" href="e-library/' . $row['id'] . '/delete"><i class="fas fa-trash"></i></a>'; }
				return  $action; 
			})
			->rawColumns(['action'])
			->make(true);
	}
    

    public function elibraries(Request $request)
    {
        $data = ELibrary::where([
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
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optView'] != 1)
        { return back(); }

        $authors = new Author();
        $publishers = new Publisher();
        $genres = new Genre();

        return view('e-library.index')
                ->with('authors', $authors->getAuthorInELibrary())
                ->with('publishers', $publishers->getPublisherInELibrary())
                ->with('genres', $genres->getGenreInELibrary());
    }

    public function front_index()
    {
        $authors = new Author();
        $publishers = new Publisher();
        $genres = new Genre();

        return view('e-library.show_front')
                ->with('authors', $authors->getAuthorInELibrary())
                ->with('publishers', $publishers->getPublisherInELibrary())
                ->with('genres', $genres->getGenreInELibrary());
    }

    public function front_getDataTable(Request $request)
	{
		if (!$request->ajax()) 
		{ return back(); }

		$model = ELibrary::query()
                    ->where(function ($q) use($request){

                    if ($request->title) 
                    { $q->where('title', 'like', '%' . $request->title . '%'); }

                    if ($request->year) 
                    { $q->where('year', 'like', '%'.$request->year.'%'); }

                    if ($request->page) 
                    { $q->where('page', 'like', '%'.$request->page.'%'); }

                    if ($request->author_id) 
                    { $q->where('author_id', $request->author_id); }
                    if ($request->publisher_id	) 
                    { $q->where('publisher_id', $request->publisher_id); }
                    if ($request->genre_id) 
                    { $q->where('genre_id', $request->genre_id); }
                    
                    $q->where('delete_status', 0);
                })
                ->orderBy('id', 'DESC')->get();

		return DataTables::of($model)
			->addIndexColumn()
            ->addColumn('author', function (ELibrary $model) {
                return $model->author_id ? $model->author->name : '-';
            })
            ->addColumn('publisher', function (ELibrary $model) {
                return $model->publisher_id ? $model->publisher->name : '-';
            })
            ->addColumn('genre', function (ELibrary $model) {
                return $model->genre_id ? $model->genre->name : '-';
            })
			->addColumn('action', function($row) {
				$action = '';
                $action .=' <a class="text-primary" href="e-libraries/' . $row['id'] . '/read"><i class="fas fa-eye"></i></a>';
				return  $action; 
			})
            ->addColumn('title_click', function($row) {
				$action = '';
                $action .=' <a class="text-primary" href="e-libraries/' . $row['id'] . '/read">'.$row['title'].'</a>';
				return  $action; 
			})
			->rawColumns(['action', 'title_click'])
			->make(true);
	}

    public function read($id)
    {
        
        $elibrary = ELibrary::where([
            ['id', '=', $id],
            ['status', '=', 1],
            ['delete_status', '=', 0],
        ])->first();
        
        if($elibrary)
        {
            $elibrary->view = $elibrary->view + 1;
            $elibrary->save();
            // dd($id,$elibrary);
            return view('e-library.read')
                    ->with('elibrary', $elibrary);
        }
        else
        { return back(); }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optCreate'] != 1)
        { return back(); }

        $authors = Author::where(function ($q) {
            $q->where('status', 1);
            $q->where('delete_status', 0);
        })->get();

        $publishers = Publisher::where(function ($q) {
            $q->where('status', 1);
            $q->where('delete_status', 0);
        })->get();

        $genres = Genre::where(function ($q) {
            $q->where('status', 1);
            $q->where('delete_status', 0);
        })->get();

        return view('e-library.create')
                ->with('authors', $authors)
                ->with('publishers', $publishers)
                ->with('genres', $genres);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optCreate'] != 1)
        { return back(); }

        // dd($request->all());

        $rules = array(
			'title' => 'required',
			'year' => 'required',
            'page' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'required',
            'book_cover' => 'required',

		);

        $messages = array(
            'title.required' => 'Title is required.',
            'year.required' => 'Year is required.',
            'page.required' => 'Page is required.',
            'author_id.required' => 'Author is required.',
            'publisher_id.required' => 'Publisher is required.',
            'genre_id.required' => 'Genre is required.',
            'book_cover.required' => 'Book Cover is required.',
            'book_file.required' => 'Book File is required.',
        );

		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) {
		return back()
			->withInput()
			->withErrors($validator);
		}

        $elibrary = new ELibrary();
        if($request->file('book_cover') != "")
        {
            $image = $request->file('book_cover');
            $upload = 'img/e_library/';
            $new_str = $elibrary->name.generateRandomString(3);
            $filename = resizeImage($new_str,$image,$upload);
            $elibrary->book_cover = $filename;
        }
        if($request->file('book_file'))
        {
            // dd($request->file('book_file')->getPathName());
            $pdfname = generateRandomString(3)."_book_file_".time().".".$request->file('book_file')->getClientOriginalExtension();
            $book_file_path = 'storage/book_file/';
            move_uploaded_file($request->file('book_file')->getPathName(), $book_file_path.$pdfname);
            $elibrary->book_file = $pdfname;
        }
        $elibrary->title = $request->title;
        $elibrary->sub_title = $request->sub_title;
        $elibrary->year = $request->year;
        $elibrary->page = $request->page;
        $elibrary->author_id = $request->author_id;
        $elibrary->publisher_id = $request->publisher_id;
        $elibrary->genre_id = $request->genre_id;
        $elibrary->status = $request->status?1:0;
        $elibrary->delete_status = 0;
        $elibrary->created_by = Auth::user()->id;
        $elibrary->created_at = Carbon::now();
        $elibrary->save();

        $elibrary_history = new ELibraryHistory();
        $elibrary_history->elibrary_id = $elibrary->id;
        $elibrary_history->title = $elibrary->title;
        $elibrary_history->sub_title = $elibrary->sub_title;
        $elibrary_history->year = $elibrary->year;
        $elibrary_history->page = $elibrary->page;
        $elibrary_history->author = $elibrary->author->name;
        $elibrary_history->publisher = $elibrary->publisher->name;
        $elibrary_history->genre = $elibrary->genre->name;
        $elibrary_history->book_cover = $elibrary->book_cover;
        $elibrary_history->book_file = $elibrary->book_file;
        $elibrary_history->status = $elibrary->status;
        $elibrary_history->delete_status = $elibrary->delete_status;
        $elibrary_history->created_by = $elibrary->created_byed->employee->name;
        $elibrary_history->created_at = $elibrary->created_at;
        $elibrary_history->save();

        toast('Book has been uploaded!','success');
        return redirect('e-library');
    }

    public function show_front($id)
    {
        // if(!isset(session('permissions')[71]) || session('permissions')[71]['optShow'] != 1)
        // { return back(); }

        $elibrary = ELibrary::findorfail($id);

        return view('e-library.show_front')
                ->with('elibrary', $elibrary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // show function
    public function show($id)
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optShow'] != 1)
        { return back(); }

        $elibrary = ELibrary::findorfail($id);
        return view('e-library.show')
                ->with('elibrary', $elibrary);
    }

    // show history function
    public function show_history(Request $request)
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optShow'] != 1)
        { return back(); }

        if (!$request->ajax()) 
		{ return back(); }

		$model = ELibraryHistory::query()
                    ->where(function ($q) use($request){
                    
                    $q->where('elibrary_id', $request->elibrary_id);
                })
                ->orderBy('id', 'DESC')->get();

        $nav = session('permissions')[75];

		return DataTables::of($model)
			->addIndexColumn()
            ->addColumn('branch', function (ELibraryHistory $model) {
                return $model->branch_id ? $model->branch->name : '-';
            })
			->addColumn('created_bys', function (ELibraryHistory $model) {
                return $model->created_by ? $model->created_by : '';
            })
            ->addColumn('updated_bys', function (ELibraryHistory $model) {
                return $model->updated_by ? $model->updated_by : '';
            })
            ->addColumn('date_time', function (ELibraryHistory $model) {
                if($model->created_at)
                { return date('d-M-Y H:s A', strtotime($model->created_at)); }
                elseif($model->updated_at)
                { return date('d-M-Y H:s A', strtotime($model->updated_at)); }
                elseif($model->deleted_at)
                { return date('d-M-Y H:s A', strtotime($model->deleted_at)); }
            })
            ->addColumn('action', function($row){
                $action = '';
                $action = '<a class="text-primary btn-show show_detail" href="/e-library/'. $row['id'] .'/history"><i
                                class="fas fa-eye"></i></a>';
                return  $action;
            })
			->rawColumns(['action'])
			->make(true);
    }

    // show history detail function
    public function show_history_detail($id)
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optShow'] != 1)
        { return back(); }

        $elibrary_history = ELibraryHistory::findorfail($id);

        return view('e-library.show_detail')
                ->with('elibrary_history',$elibrary_history);
    }

    public function show_events(Request $request)
    {
        if (!$request->ajax()) 
        { return back(); }

        $model = ELibrary::query()
                ->where(function ($q) use($request) {
                    // $q->whereDate('due_date', '<=', date("Y-m-d", strtotime(Carbon::today())));
                    $q->where('status', 1);
                    $q->where('delete_status', 0);
                })->orderBy('year', 'asc')->get();

        return response()->json($model);
    }

    public function show_events_mobile(Request $request)
    {
        $model = ELibrary::query()
                ->where(function ($q) use($request) {
                    $q->where('status', 1);
                    $q->where('delete_status', 0);
                })->orderBy('id', 'desc')->get();

        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optEdit'] != 1)
        { return back(); }

        $elibrary = ELibrary::findorfail($id);

        $authors = Author::where(function ($q) {
            $q->where('status', 1);
            $q->where('delete_status', 0);
        })->get();

        $publishers = Publisher::where(function ($q) {
            $q->where('status', 1);
            $q->where('delete_status', 0);
        })->get();

        $genres = Genre::where(function ($q) {
            $q->where('status', 1);
            $q->where('delete_status', 0);
        })->get();

        return view('e-library.edit')
                ->with('authors', $authors)
                ->with('publishers', $publishers)
                ->with('genres', $genres)
                ->with('elibrary', $elibrary);
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
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optEdit'] != 1)
        { return back(); }

        $rules = array(
			'title' => 'required',
			'year' => 'required',
            'page' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'required',
            // 'book_cover' => 'required',
            // 'book_file' => 'required',
		);

        $messages = array(
            'title.required' => 'Title is required.',
            'sub_title.required' => 'Sub Title is required.',
            'year.required' => 'Year is required.',
            'page.required' => 'Page is required.',
            'author_id.required' => 'Author is required.',
            'publisher_id.required' => 'Publisher is required.',
            'genre_id.required' => 'Genre is required.',
            'book_cover.required' => 'Book Cover is required.',
            'book_file.required' => 'Book File is required.',
        );


		$validator = Validator::make( $request->all(), $rules, $messages );
		if ($validator->fails()) {
		return back()
			->withInput()
			->withErrors($validator);
		}

        $elibrary = ELibrary::findorfail($id);
        if($request->file('book_cover') != "")
        {
            $image = $request->file('book_cover');
            $upload = 'img/e_library/';
            $new_str = $elibrary->name.generateRandomString(3);
            $filename = resizeImage($new_str,$image,$upload);
            $elibrary->book_cover = $filename;
        }
        if($request->file('book_file'))
        {
            $pdfname = generateRandomString(3)."_book_file_".time().".".$request->file('book_file')->getClientOriginalExtension();
            $book_file_path = 'storage/book_file/';
            move_uploaded_file($request->file('book_file')->getPathName(), $book_file_path.$pdfname);
            $elibrary->book_file = $pdfname;
        }
        $elibrary->title = $request->title;
        $elibrary->sub_title = $request->sub_title;
        $elibrary->year = $request->year;
        $elibrary->page = $request->page;
        $elibrary->author_id = $request->author_id;
        $elibrary->publisher_id = $request->publisher_id;
        $elibrary->genre_id = $request->genre_id;
        $elibrary->status = $request->status?1:0;
        $elibrary->delete_status = 0;
        $elibrary->updated_by = Auth::user()->id;
        $elibrary->updated_at = Carbon::now();
        $elibrary->save();

        $elibrary_history = new ELibraryHistory();
        $elibrary_history->elibrary_id = $elibrary->id;
        $elibrary_history->title = $elibrary->title;
        $elibrary_history->sub_title = $elibrary->sub_title;
        $elibrary_history->year = $elibrary->year;
        $elibrary_history->page = $elibrary->page;
        $elibrary_history->author = $elibrary->author->name;
        $elibrary_history->publisher = $elibrary->publisher->name;
        $elibrary_history->genre = $elibrary->genre->name;
        $elibrary_history->book_cover = $elibrary->book_cover;
        $elibrary_history->book_file = $elibrary->book_file;
        $elibrary_history->status = $elibrary->status;
        $elibrary_history->delete_status = $elibrary->delete_status;
        $elibrary_history->updated_by = $elibrary->updated_byed->employee->name;
        $elibrary_history->updated_at = $elibrary->updated_at;
        $elibrary_history->save();

        toast('Book has been updated!','success');
        return redirect('e-library');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!isset(session('permissions')[75]) || session('permissions')[75]['optDelete'] != 1)
        { return back(); }

        $elibrary = ELibrary::findorfail($id);
        $elibrary->delete_status = 1;
        $elibrary->deleted_by = Auth::user()->id;
        $elibrary->deleted_at = Carbon::now();
        $elibrary->save();

        $elibrary_history = new ELibraryHistory();
        $elibrary_history->elibrary_id = $elibrary->id;
        $elibrary_history->title = $elibrary->title;
        $elibrary_history->sub_title = $elibrary->sub_title;
        $elibrary_history->year = $elibrary->year;
        $elibrary_history->page = $elibrary->page;
        $elibrary_history->author = $elibrary->author->name;
        $elibrary_history->publisher = $elibrary->publisher->name;
        $elibrary_history->genre = $elibrary->genre->name;
        $elibrary_history->book_cover = $elibrary->book_cover;
        $elibrary_history->book_file = $elibrary->book_file;
        $elibrary_history->status = $elibrary->status;
        $elibrary_history->delete_status = $elibrary->delete_status;
        $elibrary_history->deleted_by = $elibrary->deleted_byed->employee->name;
        $elibrary_history->deleted_at = $elibrary->deleted_at;
        $elibrary_history->save();

        toast('Book has been deleted!','success');
        return redirect('e-library');
    }
}
