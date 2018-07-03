<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Auth;
use \App\Link;

class HomeController extends Controller
{
    public function ajax_generate_link(Request $request)
    {
    	$url = $request->input('url');
    	$hash = substr(md5(microtime()),rand(0,26),5);
    	$id = DB::table('links')->insertGetId(['hash' => $hash, 'url' => $url]);
    	return response()->json(array('id' => $id, 'hash' => $hash, 'url' => $url));
    }

    public function open_link($hash)
    {
    	$link = collect(DB::SELECT('SELECT url FROM links WHERE hash=?', [$hash]))->first();
    	return Redirect::to($link->url);
    }
}
