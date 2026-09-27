<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\PhoneModel;

class PhoneModelController extends Controller
{
    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $brands = Brand::with('phoneModels')->get();

        return view('admin.phone-models.index', compact('brands'));
    }

    // =========================
    // CREATE
    // =========================

    public function create()
    {
        $brands = Brand::all();

        return view('admin.phone-models.create', compact('brands'));
    }

    // =========================
    // STORE
    // =========================

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        PhoneModel::create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
        ]);

        return redirect('/admin/phone-models')
            ->with('success', 'Model HP berhasil ditambahkan.');
    }

    // =========================
    // SHOW
    // =========================

    public function show(PhoneModel $phoneModel)
    {
        return redirect('/admin/phone-models');
    }

    // =========================
    // EDIT
    // =========================

    public function edit(PhoneModel $phoneModel)
    {
        $brands = Brand::all();

        return view('admin.phone-models.edit', compact(
            'phoneModel',
            'brands'
        ));
    }

    // =========================
    // UPDATE
    // =========================

    public function update(Request $request, PhoneModel $phoneModel)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        $phoneModel->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
        ]);

        return redirect('/admin/phone-models')
            ->with('success', 'Model HP berhasil diperbarui.');
    }

    // =========================
    // DESTROY
    // =========================

    public function destroy(PhoneModel $phoneModel)
    {
        $phoneModel->delete();

        return redirect('/admin/phone-models')
            ->with('success', 'Model HP berhasil dihapus.');
    }
}