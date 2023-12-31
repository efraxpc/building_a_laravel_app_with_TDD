<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Incident;

CONST INCIDENT_SAVED_MSG     = 'Incident saved';
CONST INCIDENT_DELETED_MSG   = 'Incident deleted';
CONST INCIDENT_UPDATED_MSG   = 'Incident updated';



class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.incidents.index', [
            'incidents' => DB::table('incidents')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.incidents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $incident = new Incident();
        $incident->name = $request->input('name');
        $incident->save();

        $request->session()->flash('sucess', INCIDENT_SAVED_MSG);
        return redirect()->route('incidents.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incident = Incident::find($id);

        return view('admin.incidents.edit', [
            'incident' => $incident
        ]);
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
        $incident = Incident::find($request->id);

        $incident->name = $request->name;
        $incident->save();

        $request->session()->flash('sucess', INCIDENT_UPDATED_MSG);

        return view('admin.incidents.edit', [
            'incident' => $incident
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $deleted = DB::table('incidents')
            ->where('id', '=', $id)->delete();

        $request->session()->flash('sucess', INCIDENT_DELETED_MSG);
        return redirect()->route('incidents.index');
    }
}
