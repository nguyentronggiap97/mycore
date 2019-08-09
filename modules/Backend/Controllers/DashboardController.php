<?php

namespace Modules\Backend\Controllers;

use Auth;
use Modules\Store\Models\Publisher;

/**
 * Handle dashboard requests
 * @package Modules\Backend
 */
class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->has('publisher')) {
            // Get publisher stats data
            $publisher = Publisher::find($user->publisher->id ?? 0);

            // Stats data collection
            $stats = [
                'views' => $publisher->stats['views'] ?? '0',
                'orders' => $publisher->stats['orders'] ?? '0',
                'revenues' => $publisher->stats['revenues'] ?? '0',
                'discount' => $publisher->stats['discount'] ?? '0',
                'purchases' => $publisher->stats['purchases'] ?? '0',
            ];

            return view('backend::dashboard.publisher', [
                'stats' => $stats
            ]);
        } else {
            return view('backend::dashboard.index');
        }
    }
}