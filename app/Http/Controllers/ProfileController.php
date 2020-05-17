<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Storage;
use App\User;
class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }
    public function updatedp(Request $request)
    {
        $User = User::find(Auth::id());
         // Handle File Upload
        if($request->hasFile('dp')){
            // Get filename with the extension
            $filenameWithExt = $request->file('dp')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('dp')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= Auth::id().'.'.$extension;
            // Delete file if exists
            if($User->dp != "noimage.jpg")
            {
                Storage::delete('public/dps/'.$User->dp);
            }
            // Upload Image
            $path = $request->file('dp')->storeAs('public/dps', $fileNameToStore);
            
        }

        // Update User
        if($request->hasFile('dp')){
            $User->dp = $fileNameToStore;
        }
        $User->save();
        return redirect("/profile")->withStatus(__('Profile picture updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
