<?php

namespace Latfur\Event\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Latfur\Event\Models\Event;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    public function index()
    {
        $events = DB::table('events')->select('event_start_data','event_start_time','event_end_data','event_end_time',
        'faculty', 'classroom')->get();

        return view('event::calendar', compact('events'));
    }
}

