<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::latest()->paginate(10);
        return view('admin.equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable,reserved',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'category', 'stock', 'status']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        Equipment::create($data);

        return redirect()->route('admin.equipments.index')->with('message', 'Equipment created successfully.');
    }


     public function show(Equipment $equipment)
    {
        return view('admin.equipments.show', compact('equipment'));
    }


    public function edit(Equipment $equipment)
    {
        return view('admin.equipments.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable,reserved',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'category', 'stock', 'status']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $equipment->update($data);

        return redirect()->route('admin.equipments.index')->with('message', 'Equipment updated successfully.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return back()->with('message', 'Equipment deleted.');
    }
}
