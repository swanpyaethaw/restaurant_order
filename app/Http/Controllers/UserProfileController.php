<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index(){
        return view('users.profile');
    }

    public function saveProfile(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'phone' => ['required','numeric','digits:11'],
            'address' => ['required','string'],
            'image' => ['nullable','image','mimes:jpeg,jpg,png']
        ]);
        $user = User::find(auth()->user()->id);
        $user->update([
            'name' => $request->name
        ]);

        if($request->hasFile('image')){
            if(File::exists($user->profile->image)){
                File::delete($user->profile->image);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = uniqid() . "." . $ext;
            $file->move('uploads/users',$fileName);
            $fileFullName = 'uploads/users/' . $fileName;
        }

        $user->profile()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $fileFullName ?? $user->profile->image ?? null
            ]
        );

        return redirect()->back()->with('message','User Profile Updated Successfully');
    }

    public function changePassword(){
        return view('users.change-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'currentPassword' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find(auth()->user()->id);

        if(Hash::check($request->currentPassword,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect('users/profile')->with('message','Password Changed Successfully');

        }else{
            return back()->with('message','Current Password does not match with old password');
        }
    }

    public function deleteProfileImage(){
        $user = User::find(auth()->user()->id);

        if(File::exists($user->profile->image)){
            File::delete($user->profile->image);
        }
        $userProfile = UserProfile::findOrFail($user->profile->id);
        $userProfile->image = null;
        $userProfile->save();
        return redirect('users/profile')->with('message','User Profile Image Removed Successfully');

    }
}
