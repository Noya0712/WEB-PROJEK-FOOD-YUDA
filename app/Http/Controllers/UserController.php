<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }
    
    public function ProfileStore(Request $request){
        $id = Auth::guard()->id();
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $oldFotoPath = $data->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$filename);
            $data->foto = $filename;

            if ($oldFotoPath && $oldFotoPath !== $filename) {
                $this->deleteOldImage($oldFotoPath);
            }
        }
        $data->save();

        $notification = array(
            'message' => 'Profile Update Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method

    private function deleteOldImage(string $oldFotoPath): void {
        $fullPath = public_path('upload/user_images/'.$oldFotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
    //end private method

    public function UserLogout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
    //end method

    public function ChangePassword(){
        return view('frontend.dashboard.change_password');
    }
    //end method

    public function UserPasswordUpdate(Request $request){
        $user =  Auth::guard('web')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password,$user->password)) {
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        //update new password
        user::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

            $notification = array(
                'message' => 'Password Change Successfully',
                'alert-type' => 'success'
            );
            return back()->with($notification);
    }

}
