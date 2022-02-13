<?php

namespace App\Http\Controllers\API\Admin\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Service\Service;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    protected $service;
    protected $data;
    function __construct(Service $service)
    {
        $this->middleware('auth');
        $this->service =$service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['message']='Service List';
        $this->data['services']=Service::orderBy('order')->get();
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
            'summary'=>'required',
            'icon'=>'required',
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }
        $this->service->create($input);
        $this->data['message']='Successfully Created';
        $this->data['service']=$this->service;
        return response()->json($this->data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
        $this->data['message']='Service for edit';
        $this->data['service']=$service;
        return response()->json($this->data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'=>'required',
            'summary'=>'required',
            'icon'=>'required',
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }
        $this->service->update($input);
        $this->data['message']='Successfully updated';
        $this->data['service']=$this->service;
        return response()->json($this->data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();
        $this->data['message']='Successfully deleted';
        return response($this->data, 200);
    }
}
