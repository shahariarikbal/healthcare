<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminProfileSettings()
    {
        $authUser = auth()->guard('web')->user();
        return view('admin.pages.profile.settings', compact('authUser'));
    }

    public function adminProfileSettingsUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        try{
            $authUser = auth()->guard('web')->user();
            $authUser->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->back()->with('success', 'Profile setting has been updated');
            
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function adminPasswordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8'
        ]);

        try{
            $authUser = auth()->guard('web')->user();

            if(!Hash::check($request->old_password, $authUser->password)){
                return redirect()->back()->with('error', 'The provided password does not match your current password.');
            }

            //update password
            $authUser->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Password has been updated.');
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function adminLogoSettings()
    {
        $authUser = auth()->guard('web')->user();
        return view('admin.pages.profile.logo', compact('authUser'));
    }

    public function adminLogoUpdate(Request $request)
    {
        $authUser = auth()->guard('web')->user();

        if ($request->hasFile('logo')) {
               $oldImage = $authUser->logo;
               if ($oldImage && file_exists(public_path('logo/' . $oldImage))) {
                    unlink(public_path('logo/' . $oldImage));
               }
               $image = $request->file('logo');
               $imageName = time() . '.' . $image->extension();
               $image->move('logo/', $imageName);
               $authUser->logo = url('logo/'.$imageName);

               $authUser->update();
               
        }

        return redirect()->back()->with('success', 'Logo has been updated.');
          
    }
}
