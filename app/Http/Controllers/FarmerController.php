<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::all();
        return view('farmers.index', compact('farmers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:farmers,nik|max:16',
            'farmer_name' => 'required|max:100',
            'gender' => 'required|in:L,P',
        ]);

        Farmer::create($request->all());
        return redirect()->route('farmers.index')->with('success','Farmer added successfully.');
    }

    public function update(Request $request, Farmer $farmer)
    {
        $request->validate([
            'nik' => 'required|max:16|unique:farmers,nik,'.$farmer->id,
            'farmer_name' => 'required|max:100',
            'gender' => 'required|in:L,P',
        ]);

        $farmer->update($request->all());
        return redirect()->route('farmers.index')->with('success','Farmer updated successfully.');
    }

    public function destroy(Farmer $farmer)
    {
        $farmer->delete();
        return redirect()->route('farmers.index')->with('success','Farmer deleted successfully.');
    }
}
