<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Skill\Skill;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    protected $data;
    public function getSkill()
    {
        $skills = Skill::all();
        $this->data['skills']=$skills;
        $this->data['message']='Skill List';
        return response()->json($this->data, 200);
    }
}
