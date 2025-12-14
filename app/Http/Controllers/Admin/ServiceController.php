<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $service = new Service();
    $service->name = $request->name;
    $service->description = $request->description;
    $service->price = $request->price;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/services'), $imageName);
        $service->image = 'uploads/services/' . $imageName;
    }

    $service->save();

    return redirect()->back()->with('success', 'Service added successfully!');
}

public function update(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $service->name = $request->name;
    $service->description = $request->description;
    $service->price = $request->price;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/services'), $imageName);
        $service->image = 'uploads/services/' . $imageName;
    }

    $service->save();

    return redirect()->back()->with('success', 'Service updated successfully!');
}

public function destroy($id)
{
    Service::findOrFail($id)->delete();

    return back()->with('success', 'Service deleted successfully!');
}

}
