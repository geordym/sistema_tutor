<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AlumnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAuthenticatedId = Auth::id();
        $alumns = Alumn::orderBy('created_at', 'DESC')->where('collaborator_id', $userAuthenticatedId)->get();
        return view('collaborators.alumns.index')->with('alumns', $alumns);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collaborators.alumns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255', 
            'curp' => 'required|string|unique:alumns,curp|max:25',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $userAuthenticatedId = Auth::id();

        try {
            $alumn = Alumn::create([
                'fullname' => $request->input('fullname'),
                'curp' => $request->input('curp'),
                'collaborator_id' => $userAuthenticatedId,
            ]);
    
            return redirect()->route('collaborators.alumns.index')->with('success', 'Alumno creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el alumno: ' . $e->getMessage())->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
