<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $equipments = Equipment::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('editors.equipments.index', compact('equipments', 'search'));
    }

    public function show2($id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('editor.equipments.show', compact('equipment'));
    }

    public function create()
    {
        return view('editors.equipments.create');
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
        return redirect()->route('editors.equipments.index')->with('message', 'Equipment added successfully.');
    }

    public function edit(Equipment $equipment)
    {
        return view('editors.equipments.edit', compact('equipment'));
    }


     
     public function show(Equipment $equipment)
    {
        return view('editors.equipments.show', compact('equipment'));
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
        return redirect()->route('editors.equipments.index')->with('message', 'Equipment updated.');
    }


     public function destroy(Equipment $equipment)
    {
        if ($equipment->rentals()->where('status', '!=', 'returned')->exists()) {
            return back()->with('error', 'Equipment cannot be deleted while in use.');
        }

        $equipment->delete();
        return redirect()->route('admin.equipments.index')->with('success', 'Equipment deleted successfully.');
    }
    // public function destroy(Equipment $equipment)
    // {
    //     $equipment->delete();
    //     return back()->with('message', 'Equipment deleted.');
    // }
}
