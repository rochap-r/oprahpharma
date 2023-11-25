<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }

    public function index()
    {
        return view('users.index');
    }

    public function changeImage(Request $request)
    {
        $folder='pictures';
        $user=User::find(auth()->id());

        $picture=$request->file('picture');
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        if($user->image!==null){
            $deletePath = $user->image->path;
            if ($deletePath !== null && Storage::disk('public')->exists($deletePath)) {
                Storage::disk('public')->delete($deletePath);
            }
        }

        $path=$picture->store($folder,'public');
        $fileName=$picture->getClientOriginalName();
        $extension=$picture->getClientOriginalExtension();
        //création de Profile
        if($user->image){
            $result=$user->image()->update([
                'name'=>$fileName,
                'extension'=>$extension,
                'path'=>$path
            ]);
        }else{
            $result=$user->image()->create([
                'name'=>$fileName,
                'extension'=>$extension,
                'path'=>$path
            ]);
        }


        if($result){
            return response()->json(['status'=>1,'msg'=>'Votre image de profile a bien été mise à jour']);
        }else{
            return response()->json(['status'=>0,'msg'=>'Oups! Quelque ne va pas bien']);
        }
    }


}
