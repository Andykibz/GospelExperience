<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index')->with(['pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required',
            'body' => 'bail|required'
        ]);
        $page = new Page();
        $page->title    = $request->title;
        $page->slug    =  slugify($page,$request->title);
        $page->group    = $request->group;
        $page->body    = $request->body;
        $page->save();
        Session::flash('success',"$page->title Created Succesfully");
        return redirect()->route('admin.page.show',$page->id );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);
        return view('admin.page.show')->with([ 'page' => $page ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit')->with([ 'page' => $page ]);
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
        $request->validate([
            'title' => 'bail|required',
            'body' => 'bail|required'
        ]);
        $page = Page::find($id);
        $page->title    = $request->title;
        $page->slug     =  slugify($page,$request->title);
        $page->group    = $request->group;
        $page->body     = $request->body;
        $page->save();
        Session::flash('info',"$page->title updated Succesfully");
        return redirect()->route('admin.page.show',$page->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( Page::destroy($id) ):
            Session::flash('warning',"Page deleted ");
        else:
            abort(404);
            Session::flash('danger',"Page could not be found ");
        endif;
        return redirect()->route('admin.page.index');
    }
}
