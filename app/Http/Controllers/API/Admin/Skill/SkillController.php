<?php



namespace App\Http\Controllers\API\Admin\Skill;

use Illuminate\Http\Request;
use App\Models\Admin\Skill\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{ 
    protected $skill;
    protected $data;
    function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['skills']=Skill::orderBy('order')->get();
        $this->data['message']='Slill List';
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
        $validator = Validator::make($input, [
            'title'=>'required',
            'precentage'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $this->skill->create($input);
        $this->data['skill']=$this->skill;
        $this->data['message']='Successfully Skill has added';
        return response()->json($this->data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Skill\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
        $this->data['message']='Skill for edit';
        $this->data['skill']=$skill;
        return response($this->data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Skill\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Skill\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        //
        $input = $request->all();
        $this->skill=$skill;
        $validator = Validator::make($input, [
            'title'=>'required',
            'precentage'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $this->skill->update($input);
        $this->data['skill']=$this->skill;
        $this->data['message']='Successfully Skill has added';
        return response()->json($this->data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Skill\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
        $skill->delete();
        $this->data['message']='Successfully Deleted';
        return response()->json($this->data, 200);
    }
    public function updateOrder(Request $request)
    {
        // return $request->skills;
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);

        $tasks = Skill::all();
        // return $tasks;
        $skills = $request->skills;
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
