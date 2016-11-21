<?php

namespace Nxb\Timezones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimezonesController extends Controller
{
    //

	public function index($timezone=NULL){


        $current_time = ($timezone)
            ? Carbon::now(str_replace('-', '/', $timezone))
            : Carbon::now();
            
        //echo $time->toDateTimeString();
        return view('timezones::time', compact('current_time'));

		//echo Carbon::now($timezone)->toDateTimeString();
	}

}
