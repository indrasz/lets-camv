<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DestinationGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\DestinationRequest;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Destination::with(['category']);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="px-4 py-2 mt-2 mr-2 text-left text-white rounded-xl bg-serv-email"
                        href="' . route('dashboard.destination.edit', $item->id) . '">
                        Edit
                    </a>

                    <form class="inline-block" action="' . route('dashboard.destination.destroy', $item->id) . '" method="POST">
                        <button class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email" >
                            Hapus
                        </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        $destination = Destination::all();
        return view('pages.dashboard.destination.index', compact('destination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboard.destination.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // add to service
        $destination = Destination::create($data);
        // add to thumbnail service
        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $destination_galleries = new DestinationGallery();
                $destination_galleries->destinations_id = $destination['id'];
                $destination_galleries->photos = $path;
                $destination_galleries->save();
            }
        }

        toast()->success('Save has been success');
        return redirect()->route('dashboard.destination.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        $thumbnail_service = DestinationGallery::where('destinations_id', $destination['id'])->get();
        $categories = Category::all();
        return view('pages.dashboard.destination.edit', compact('destination', 'categories', 'thumbnail_service'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DestinationRequest $request, Destination $destination)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // update to service
        $destination->update($data);

        // update to thumbnail service
        if($request->hasfile('photos')){
            foreach ($request->file('photos') as $key => $file)
            {
                // get old photo thumbnail
                $get_photo = DestinationGallery::where('id', $key)->first();

                // store photo
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                // update thumbail
                $thumbnail_service = DestinationGallery::find($key);
                $thumbnail_service->photos = $path;
                $thumbnail_service->save();

                // delete old photo thumbnail
                $data = 'storage/'.$get_photo['photo'];
                if(File::exists($data)){
                    File::delete($data);
                }else{
                    File::delete('storage/app/public/'.$get_photo['photo']);
                }
            }
        }

        // add to thumbnail service
        if($request->hasfile('photo')){
            foreach($request->file('photo') as $file)
            {
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $thumbnail_service = new DestinationGallery();
                $thumbnail_service->destinations_id = $destination['id'];
                $thumbnail_service->photos = $path;
                $thumbnail_service->save();
            }
        }

        toast()->success('Update has been success');
        return redirect()->route('dashboard.destination.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = Destination::findorFail($id);
        $destination->delete();
        toast()->success('Delete has been success');
        return redirect()->route('dashboard.destination.index');
    }
}
