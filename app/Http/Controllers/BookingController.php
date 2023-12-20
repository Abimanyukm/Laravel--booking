<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){


        
        $name= request('name');
        $date= request('date');
        
        $slot= request('slot');
        

        Slot::insert([
            'name' => $name,
            'date' => $date,
            'slot' => $slot,
            
        ]);
        return redirect()->route('index')->with('message','slot added');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
