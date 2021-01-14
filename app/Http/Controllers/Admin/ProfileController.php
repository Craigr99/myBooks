<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.profile');
    }
    public function update(Request $request)
    {
        $rules = [
            'f_name' => 'required|string|min:3|max:191',
            'l_name' => 'required|string|min:3|max:191',
            'email' => 'required|email|min:3|max:191',
            'password' => 'nullable|string|min:5|max:191',
            'image' => 'nullable|image|max:1999',
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

        return redirect()->route('admin.profile');
    }
}
