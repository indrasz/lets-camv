<?php

namespace App\Http\Controllers\Admin;

use App\Models\Camv;
use App\Models\FeatureCamv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\CamvRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CamvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Camv::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="px-4 py-2 mt-2 mr-2 text-left text-white rounded-xl bg-serv-email"
                        href="' . route('dashboard.camv.edit', $item->id) . '">
                        Edit
                    </a>

                    <form class="inline-block" action="' . route('dashboard.camv.destroy', $item->id) . '" method="POST">
                        <button class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email" >
                            Hapus
                        </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . Storage::url($item->photo) . '" style="max-height: 100px; max-width:100px"/>' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }
        $camv = Camv::all();
        return view('pages.dashboard.camv.index', compact('camv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pages.dashboard.camv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CamvRequest $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/service/thumbnail', 'public');
        // add to service
        $service = Camv::create($data);

        // add to advantage service
        foreach ($data['feature'] as $key => $value) {
            $feature_camv = new FeatureCamv();
            $feature_camv->camvs_id = $service->id;
            $feature_camv->feature = $value;
            $feature_camv->save();
        }
        toast()->success('Save has been success');
        return redirect()->route('dashboard.camv.index');
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
    public function edit(Camv $camv)
    {
        $feature = FeatureCamv::where('camvs_id', $camv['id'])->get();
        return view('pages.dashboard.camv.edit', compact('camv', 'feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CamvRequest $request, Camv $camv)
    {
        $data = $request->all();
        // update to service
        $camv->update($data);

        foreach ($data['features'] as $key => $value) {
            $feature_camv = FeatureCamv::find($key);
            $feature_camv->feature = $value;
            $feature_camv->save();
        }

        //add new advantage service
        if(isset($data['feature'])){
            foreach($data['feature'] as $key => $value){
                $feature = New FeatureCamv();
                $feature->camvs_id = $camv['id'];
                $feature->feature = $value;
                $feature->save();
            }
        }

        if($request->file('photo')){
            foreach ($request->file('photo') as $key => $file)
            {
                // get old photo thumbnail
                $get_photo = Camv::where('id', $key)->first();

                // store photo
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                // update thumbail
                $thumbnail_service = Camv::find($key);
                $thumbnail_service->photo = $path;
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
        toast()->success('Save has been success');
        return redirect()->route('dashboard.camv.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camv = Camv::findorFail($id);
        Alert::warning('are you sure');
        $camv->delete();
        toast()->success('Delete has been success');
        return redirect()->route('dashboard.camv.index');
    }
}
