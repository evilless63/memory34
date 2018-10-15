<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Information;

class InformationController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editInfo()
    {
        $info = Information::first();
        return view('admin.information.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $info = Information::findOrfail('1');
        $info->update($request->all());
        return view('admin.information.edit', compact('info'));
    }


}
