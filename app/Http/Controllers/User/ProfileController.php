<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }
    public function index()
    {
        return view('user.profile.index');
    }

    public function edit()
    {
        return view('user.profile.edit');
    }

    public function update(Request $request)
    {
        $rules = [
            'f_name' => 'required|string|min:3|max:191',
            'l_name' => 'required|string|min:3|max:191',
            'email' => 'required|email|min:3|max:191',
            'password' => 'nullable|string|min:5|max:191',
            'image' => 'nullable|image',
        ];

        $request->validate($rules);

        $user = Auth::user();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$user->image}");
            $user->image = $filename;
        }

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('info', 'Profile updated successfully!');

        return redirect()->route('user.profile.index');
    }
}
