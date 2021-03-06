<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdu1;
class Sdu1Controller extends Controller
{
    public function addStory(){
        return view('add-story');
    }
    public function storeStory(Request $request){
        $name = $request->name;
        $email = $request->email;
        $topic = $request->topic;
        $story = $request->story;
        $image = $request->file;
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $sdu1 = new Sdu1();
        $sdu1->name = $name;
        $sdu1->email = $email;
        $sdu1->topic = $topic;
        $sdu1->story = $story;
        $sdu1->image = $imageName;
        $sdu1->save();
        return back()->with('story_added' , 'story record has been inserted');

    }
public function users(){

    $sduies = Sdu1::all();

    return view('all-users',compact('sduies'));
}
public function editUser($id){
    $sdu1 =Sdu1::find($id);
    return view('edit-user',compact('sdu1'));
}
public function updateUser(Request $request){
    $name = $request->name;
    $email = $request->email;
    $topic = $request->topic;
    $story = $request->story;
    $image = $request->file;
    $imageName = time().'.'.$image->extension();
    $image->move(public_path('images'),$imageName);

    $sdu1 = Sdu1::find($request->id);
        $sdu1->name = $name;
        $sdu1->email = $email;
        $sdu1->topic = $topic;
        $sdu1->story = $story;
        $sdu1->image = $imageName;
        $sdu1->save();
        return back()->with('user_update' , 'Story updated successfully!');
}
public function deleteUser($id){
    $sdu1 = Sdu1::find($id);
    unlink(public_path('images').'/'.$sdu1->image);
    $sdu1->delete();
    return back()->with('user_deleted','User deleted successfully!');
}
function index(){
return view('send_email');
}
function send(Request $request){
    $this->validate($request,[
        'name'     =>    'required',
        'email'    =>    'required|email',
        'message'  =>    'required'
    ]);
}
}
