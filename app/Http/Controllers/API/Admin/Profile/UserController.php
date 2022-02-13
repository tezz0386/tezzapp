<?php

namespace App\Http\Controllers\Api\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\ImageSupport;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $data;
    function __construct()
    {
        $this->middleware('auth');
    }
    public function getUser()
    {
        $this->data['message']='USer for edit';
        $this->data['user']=User::find(1);
        return response()->json($this->data, 200);
    }
    public function uploadProfile(Request $request, User $user)
    {
        $imageSupport = new ImageSupport();
        $imageSupport->deleteImg('profile', $user->image);
        $user->image = $imageSupport->saveAnyImg($request, 'profile', 'image', 500, 500);
        $user->save();
        $this->data['message']='Successfully image uploaded';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
    public function updateName(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->save();
        $this->data['message']='Successfully name updated';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
    public function updateEmail(Request $request, User $user)
    {
        $user->email = $request->email;
        $user->save();
        $this->data['message']='Successfully email updated';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
    public function updateContact(Request $request, User $user)
    {
        $user->contact_no = $request->contact_no;
        $user->save();
        $this->data['message']='Successfully Contact No updated';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
    public function updateCV(Request $request, User $user)
    {
        $user->contact_no = $request->contact_no;
        $user->save();
        $this->data['message']='Successfully Contact No updated';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
    public function updateDesignation(Request $request, User $user)
    {
        $user->designation = $request->designation;
        $user->save();
        $this->data['message']='Successfully designation No updated';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
    public function updateAbout(Request $request, User $user)
    {
        $user->summary = $request->summary;
        $user->description = $request->description;
        $user->save();
        $this->data['message']='Successfully designation No updated';
        $this->data['user']=$user;
        return response()->json($this->data, 200);
    }
}
