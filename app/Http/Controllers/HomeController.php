<?php

namespace App\Http\Controllers;

use Auth;
use Modules\Media\Models\Media;
use Modules\Store\Models\Publisher;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirect to {admin} when login auth
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $pub = Publisher::first();
        // $user = Auth::user();
        // $user->publisher = $pub->getEmbedded()->toArray();
        // $user->save();

        return redirect()->route('admin.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        return view('admin');
    }
}
