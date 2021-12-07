<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RightsGroup;
use Illuminate\Http\Request;
use App\Rules\ValidPassword;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = (new User)->view(null);
        return view('user.index', compact('users'));
    }


    /**
     * Display a listing of user types
     *
     *@param string $page
     * @return \Illuminate\View\View
     */
    public function users(string $role)
    {
        $users = (new User)->view($role);
        return view('user.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'first_name' => 'required|max:100',
            'middle_name' => 'present|max:100',
            'last_name' => 'required|max:100',
            'garage' => 'nullable|numeric|gt:0|required_unless:rights_group,1',
            'email' => 'required|email|unique:users',
            'password' => ['required', new ValidPassword()],
            'rights_group' => ['required', 'numeric', Rule::notIn([0])],
        ]);

        $user = (new User)->add($request);

        if ($user) {
            return back()->withStatus(__('User successfully added.'));
        } else {
            return redirect('user.create')->withStatusFail(__('User was not added.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'first_name' => 'required|max:100',
            'middle_name' => 'present|max:100',
            'last_name' => 'required|max:100',
            'garage' => 'present|numeric',
            'rights_group' => ['required', 'numeric', Rule::notIn([0])],
        ]);

        $userUpdate = (new User)->updateUser($request, $user);

        if ($userUpdate) {
            return back()->withStatus(__('User successfully updated.'));
        } else {
            return back()->withStatusFail(__('User was not updated.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        request()->validate([
            'user_id' => 'required|numeric|gt:0'
        ]);

        $userDelete = (new User)->deleteUser($request);

        if ($userDelete) {
            return back()->withStatus(__('User successfully deleted.'));
        } else {
            return back()->withStatusFail(__('User was not updated.'));
        }
    }
}
