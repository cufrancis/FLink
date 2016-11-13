<?php

namespace App\Http\Controllers;

use App\Model\User;
use View;
use Debugbar;
use App\Model\Link;
use App\Model\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Cache;


class IndexController extends Controller
{

    public function __construct(){
        $user = Auth::user();

        $this->user = $user;
        View::share("user", $user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   $links = Cache::remember('links.index', Setting()->get('website_cache_time'), function() {
          $links = Link::paginate(8);
    //   });
    //   dd($links->links());


      return view('theme::home.index')->with(compact('links'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
