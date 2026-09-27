<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Damage;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    public function index()
    {
        $damages = Damage::all();

        return view('admin.damages.index', compact('damages'));
    }

    public function create()
    {
        return view('admin.damages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'severity' => 'required|in:light,moderate,heavy',
            'name' => 'required',
            'price_min' => 'required|numeric',
            'price_max' => 'required|numeric',
            'estimated_days' => 'required|integer'
        ]);

        Damage::create([
            'severity' => $request->severity,
            'name' => $request->name,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'estimated_days' => $request->estimated_days
        ]);

        return redirect()->route('damages.index');
    }

    public function edit($id)
    {
        $damage = Damage::findOrFail($id);

        return view('admin.damages.edit', compact('damage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'severity' => 'required|in:light,moderate,heavy',
            'name' => 'required',
            'price_min' => 'required|numeric',
            'price_max' => 'required|numeric',
            'estimated_days' => 'required|integer'
        ]);

        $damage = Damage::findOrFail($id);

        $damage->update([
            'severity' => $request->severity,
            'name' => $request->name,
            'price_min' => $request->price_min,
            'price_max' => $request->price_max,
            'estimated_days' => $request->estimated_days
        ]);

        return redirect()->route('damages.index');
    }

    public function destroy($id)
    {
        $damage = Damage::findOrFail($id);

        $damage->delete();

        return redirect()->route('damages.index');
    }
}