<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::all();
        return view('managers.index', compact('managers'));
    }

    public function create()
    {
        return view('managers.create');
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:managers,email',
        'password' => 'required|string|min:8',
    ]);

    // Create a new manager instance
    $manager = new Manager();
    
    // Assign validated data to the manager attributes
    $manager->name = $validatedData['name'];
    $manager->email = $validatedData['email'];
    $manager->password = bcrypt($validatedData['password']);
    
    // Save the manager to the database
    $manager->save();

    // Redirect the user to the index page
    return redirect()->route('managers.index');
}

    public function edit($id)
    {
        $manager = Manager::find($id);
        return view('managers.edit', compact('manager'));
    }

public function update(Request $request, $id)
{
    // Find the manager by ID
    $manager = Manager::find($id);
    
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('managers')->ignore($manager->id),
        ],
        'password' => 'required|string|min:8',
    ]);

    // Update the manager attributes with validated data
    $manager->name = $validatedData['name'];
    $manager->email = $validatedData['email'];
    $manager->password = bcrypt($validatedData['password']);
    
    // Save the updated manager to the database
    $manager->save();

    // Redirect the user to the index page
    return redirect()->route('managers.index');
}


    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();

        return redirect()->route('managers.index');
    }
}
