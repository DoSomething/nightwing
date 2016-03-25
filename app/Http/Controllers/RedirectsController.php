<?php

namespace Nightwing\Http\Controllers;

use Illuminate\Http\Request;
use Nightwing\Http\Requests;
use Nightwing\Http\Controllers\Controller;

use Nightwing\Models\Redirect;

class RedirectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirects = Redirect::orderBy('created_at', 'desc')->get();

        return view('redirects.index', [
            'redirects' => $redirects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $redirect = Redirect::create($request->all());
        return redirect()->route('redirects.index')->with('flash_message', [
            'class' => 'messages',
            'text' => 'Redirect created!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $redirect = Redirect::find($id);
        return view('redirects.show', compact('redirect'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redirect = Redirect::find($id);
        return view('redirects.edit', compact('redirect'));
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
        $redirect = Redirect::find($id);
        var_dump($request->all());
        // $input = Request::all();
        $redirect->update($request->all());
        return redirect('redirects');
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
