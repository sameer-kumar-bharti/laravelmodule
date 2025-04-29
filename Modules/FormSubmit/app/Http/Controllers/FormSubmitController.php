<?php

namespace Modules\FormSubmit\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\FormSubmit\App\Models\Formdata;


class FormSubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('formsubmit::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formsubmit::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required'
        ]);

        $formdata = new Formdata();
        $formdata->name = $request->name;
        $formdata->email = $request->email;
        $formdata->message = $request->message;
        if($formdata->save()){
            return redirect()->back()->with('success','Successfully Added');
        }else{
            return redirect()->back()->with('danger','Something wrong !');
        }
        

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('formsubmit::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('formsubmit::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
