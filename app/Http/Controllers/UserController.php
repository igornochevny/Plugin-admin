<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('password', null)->get();

        $data['users'] = $users;

        return view('home', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param User $template
     */
    public function store(Request $request)
    {
        $user = new User();

        if (!empty($request->username)) {
            $user->username = $request->username;
            $user->password = null;
            $user->secret_key = $this->randomPassword();
        }else{
            return redirect()->route('home');
        }

        $user->save();

        return redirect()->route('home')->withMessage('User has been added');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, User $user)
    {
        if (!empty($request->username)) {
            $user->username = $request->username;
        }else{
            return redirect()->route('users.edit');
        }
        $user->save();
        return redirect()->route('home')->withMessage('User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home')->withMessage('User has been deleted');
    }

    public function randomPassword(){
        return $random_password = date("m").str_random(8).date("ds");
    }

    public function activate(User $user){
        $user->is_activated = 1;
        $user->save();

        return redirect('/');
    }

    public function deactivate(User $user){
        $user->is_activated = 0;
        $user->save();

        return redirect('/');
    }
}
