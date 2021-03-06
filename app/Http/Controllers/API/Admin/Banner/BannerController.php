<?php

namespace App\Http\Controllers\API\Admin\Banner;

use Illuminate\Http\Request;
use App\Models\Admin\Banner\Banner;
use App\Http\Controllers\Controller;
use App\Support\ImageSupport;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    protected $banner;
    protected $imageSupport;
    protected $data;
    protected $imageHeight=700;
    protected $imageWidth=1200;
    function __construct(Banner $banner, ImageSupport $imageSupport)
    {
        $this->middleware('auth');
        $this->imageSupport = $imageSupport;
        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['banners']=Banner::orderBy('order', 'asc')->get();
        $this->data['message']='Banner List';
        return response()->json($this->data, 200);
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
        // return $request;
        $input = $request->all();
        $validator= Validator::make($input, [
            'title'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
            'btn_text'=>'required',
            'url'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $input['image']=$this->imageSupport->saveAnyImg($request, 'banners', 'image', $this->imageWidth, $this->imageHeight);
        $this->banner->create($input);
        $this->data['message']='Successfully Created';
        $this->data['banner']=$this->banner;
        return response()->json($this->data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Banner\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
        $this->data['message']='Banner For Edit';
        $this->data['banner']=$banner;
        return response()->json($this->data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Banner\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
        $this->data['message']='Banner For Edit';
        $this->data['banner']=$banner;
        return response()->json($this->data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Banner\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
        // return $request;
        $this->banner=$banner;
        $input = $request->all();
        $validator= Validator::make($input, [
            'title'=>'required',
            // 'image'=>'sometimes|mimes:jpg,png,jpeg',
            'btn_text'=>'required',
            'url'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        if(!$request->file('image')==''){
            $this->imageSupport->deleteImg('banners', $banner->image);
            $input['image']=$this->imageSupport->saveAnyImg($request, 'banners', 'image', $this->imageWidth, $this->imageHeight);
        }
        $this->banner->update($input);
        $this->data['message']='Successfully Updated';
        $this->data['banner']=$this->banner;
        return response()->json($this->data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Banner\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
        $this->data['message']='Successfully Deleted';
        $banner->delete();
        return response()->json($this->data);
    }
    public function updateOrder(Request $request)
    {
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);

        $tasks = Banner::all();
        $banners = $request->banners;
        $count = count($banners);
        foreach ($tasks as $task) {
            $id = $task->id;
            for($i=0; $i<$count-1; $i++){
                if ($banners[$i]['id'] == $id) {
                    $task->update(['order' => $banners[$i]['order']]);
                }
            }
        }
        return response('Updated Successfully.', 200);
    }
}
