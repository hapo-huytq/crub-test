<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use Vallidator;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersObj = new User();
        $users = $usersObj->all();
        return view('users.pages.home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $userAvatar = '';
        if ($request->hasFile('avatar')) {
            $fileExtension = '.'.$request->avatar->extension();
            $imageName = 'img'.uniqid().$fileExtension;
            $request->file('avatar')->storeAs('', $imageName, 'avatar_upload');
            $userAvatar = $imageName;
        }
        $storing = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => $request->user_type,
            'phone' => $request->phone,
            'avatar' => $userAvatar,
        ]);
        if($storing == true) {
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.pages.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.pages.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        $user->phone = $request->phone;
        if ($request->hasFile('avatar')) {
            Storage::disk('avatar_upload')->delete($user->avatar);
            $fileExtension = '.'.$request->avatar->extension();
            $imageName = 'img'.uniqid().$fileExtension;
            $request->file('avatar')->storeAs('', $imageName, 'avatar_upload');
            $user->avatar = $imageName;
        }
        $update = $user->save();
        if($update == true) {
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Storage::disk('avatar_upload')->delete($user->avatar);
        $delete = $user->delete();
        if($delete == true) {
            return redirect()->route('users.index');
        }
    }
}
