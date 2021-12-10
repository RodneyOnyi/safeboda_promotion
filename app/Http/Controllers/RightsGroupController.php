<?php

namespace App\Http\Controllers;

use App\Models\RightsGroup;
use Illuminate\Http\Request;

class RightsGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rights = (new RightsGroup)->view();
        return view('rights.index', compact('rights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rights.create');
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
     * @param  \App\Models\RightsGroup  $rightsGroup
     * @return \Illuminate\Http\Response
     */
    public function show(RightsGroup $rightsGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RightsGroup  $rightsGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(RightsGroup $rightsGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RightsGroup  $rightsGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RightsGroup $rightsGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        request()->validate([
          'rights_id'=>'required|numeric|gt:0'
        ]);

        $rightsDelete = (new RightsGroup)->deleteGroup($request);

        if ($rightsDelete) {
            return back()->withStatus(__('Rights successfully deleted.'));
        } else {
            return back()->withStatusFail(__('Rights was not updated.'));
        }
    }
}
