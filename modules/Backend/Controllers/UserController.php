<?php

namespace Modules\Backend\Controllers;

use Auth;
use Datatables;

use App\User;
use App\Role;
use App\Perm;
use App\Guid;

use Modules\Media\Models\Media;
use Modules\Backend\DataTables\UserDataTable;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

/**
 * Handle user requests
 * @package Modules\Backend
 */
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = User::count();
        return view('backend::users.index', compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend::users.create', [
            'roles' => Role::all(),
            'collection' => User::getCollection(),
        ]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $profile = $request->all();
        $profile['_id'] = Guid::next();
        $profile['roles'] = $request->input('roles') ?? [];
        $profile['password'] = bcrypt($request->input('password'));
        $profile['remember'] = Str::random(60);

        User::create($profile);

        return redirect()->route('users.index')->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend::users.show', [
            'node' => $user,
            'roles' => Perm::modules(),
            'collection' => User::getCollection(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend::users.edit', [
            'node' => $user,
            'roles' => Role::all(),
            'collection' => User::getCollection(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $profile = $request->all();
        $status  = $request->input('status');

        // Check for user status change
        if ($user->status != $status) {
            // Check for undelete user, update deleted_at to null
            if ($user->status == User::STATUS_DELETED) {
                $profile[User::DELETED_AT] = null;
            }

            // Check for delete user, update deleted_at to now()
            if ($status == User::STATUS_DELETED) {
                $profile[User::DELETED_AT] = now();
            }

            $profile['status'] = intval($status);
        }

        // Check for user avatar
        if ($request->input('avatar')) {
            $avatar = Media::firstOrNew(['_id' => $request->input('avatar')], []);
            $profile['avatar'] = $avatar->getEmbedded()->toArray();
        } else {
            unset($profile['avatar']);
        }

        if ($request->input('cover')) {
            $cover = Media::firstOrNew(['_id' => $request->input('cover')], []);
            $profile['cover'] = $cover->getEmbedded()->toArray();
        } else {
            unset($profile['cover']);
        }

        $user->update($profile);

        return redirect()->back()->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->update([
            'status' => User::STATUS_DELETED
        ]);

        $user->delete();

        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

    /**
     * Change user password
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request, User $user)
    {
        request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => bcrypt($request->input('password')),
            'remember' => Str::random(60),
        ]);

        return redirect()->back()->with('success','Change user password successfully');
    }

    /**
     * Search user for select2 ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $id = $request->input('id');
        $query = $request->input('term.term');
        $users = User::where('name', 'like', $query . '%')->get(['_id', 'name']);
        return $users;
    }

    /**
     * Datatable ajax request
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(UserDataTable $datatable)
    {
        return $datatable->build()->toJson();
    }
}