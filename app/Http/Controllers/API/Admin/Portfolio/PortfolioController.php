<?php

namespace App\Http\Controllers\API\Admin\Profile;

use Illuminate\Http\Request;
use App\Support\ImageSupport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Portfolio\Portfolio;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    protected $portfolio;
    protected $imageWidth=500;
    protected $imageHeight=300;
    protected $data;
    protected $imageSupport;
    function __construct(Portfolio $portfolio, ImageSupport $imageSupport)
    {
        $this->middleware('auth');
        $this->portfolio=$portfolio;
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
        $this->data['message']='Portfolio List';
        $this->data['portfolios']=Portfolio::orderBy('order')->get();
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
            'image'=>'required|mimes:jpg,jpeg,png',
            'type'=>'required',
            'url'=>'required',
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }
        $input['image']=$this->imageSupport->saveAnyImg($request, 'portfolios', 'image', $this->imageWidth, $this->imageHeight);
        $this->portfolio->create($input);
        $this->data['message']='Successfully Saved';
        $this->data['portfolio']=$this->portfolio;
        return response()->json($this->data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
        $this->data['message']='Portfolio for edit';
        $this->data['portfolio']=$portfolio;
        return response()->json($this->data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'=>'required',
            'type'=>'required',
            'url'=>'required',
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }
        $this->portfolio = $portfolio;
        if(!$request->file('image')==''){
            $this->imageSupport->deleteImg('portfolios', $this->portfolio->image);
            $input['image']=$this->imageSupport->saveAnyImg($request, 'portfolios', 'image', $this->imageWidth, $this->imageHeight);
        }
        $this->portfolio->update($input);
        $this->data['message']='Successfully Updated';
        $this->data['portfolio']=$this->portfolio;
        return response()->json($this->data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
        $this->imageSupport->deleteImg('portfolios', $portfolio->image);
        $portfolio->delete();
        $this->data['message']='Successfully Deleted';
        return response()->json($this->data, 200);

    }

    public function updateOrder(Request $request)
    {
        // return $request->skills;
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);

        $tasks = Portfolio::all();
        // return $tasks;
        $skills = $request->portfolios;
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
