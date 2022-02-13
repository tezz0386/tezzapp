<?php

namespace App\Http\Controllers\API\Admin\Blog;

use Illuminate\Http\Request;
use App\Support\ImageSupport;
use App\Models\Admin\Blog\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    protected $blog;
    protected $imageWidth=500;
    protected $imageHeight=300;
    protected $imageSupport;
    protected $data;
    function __construct(Blog $blog, ImageSupport $imageSupport)
    {
        $this->middleware('auth');
        $this->blog = $blog;
        $this->imageSupport = $imageSupport;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['message']='blog list';
        $this->data['blogs']=Blog::orderByDesc('created_at')->get();
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
            'summary'=>'required',
            'content'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors);
        }
        $input['image']=$this->imageSupport->saveAnyImg($request, 'blogs', 'image', $this->imageWidth, $this->imageHeight);
        $this->blog->create($input);
        $this->data['message']='Successfully created';
        $this->data['blog']=$this->blog;
        return response()->json($this->data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Blog\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
        $this->data['message']='Blog for edit';
        $this->data['blog']=$blog;
        return response()->json($this->data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Blog\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Blog\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'=>'required',
            'summary'=>'required',
            'content'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors);
        }
        if(!$request->file('image')==''){
            $this->imageSupport->deleteImg('blogs', $blog->image);
            $input['image']=$this->imageSupport->saveAnyImg($request, 'blogs', 'image', $this->imageWidth, $this->imageHeight);
        }
        $this->blog=$blog;
        $this->blog->update($input);
        $this->data['message']='Successfully updated';
        $this->data['blog']=$this->blog;
        return response()->json($this->data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Blog\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
        $blog->delete();
        $this->data['message']='Successfully Deleted';
        return response()->json($this->data, 200);
    }

    public function updateOrder(Request $request)
    {
        // return $request->skills;
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);

        $tasks = Blog::all();
        // return $tasks;
        $skills = $request->blogs;
        $count = count($skills);
        foreach ($tasks as $task) {
            $id = $task->id;
            for($i=0; $i<$count-1; $i++){
                if ($skills[$i]['id'] == $id) {
                    // $task->update(['order' => $skills[$i]['order']]);
                    $task->order = $skills[$i]['order'];
                    $task->save();
                }
            }
        }
        return response('Updated Successfully.', 200);
    }
}
