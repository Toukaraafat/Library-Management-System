<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

    class AdminController extends Controller
    {
        public function makeUserAdmin()
        {
            // Find the admin role
            $adminRole = Role::where('name', 'admin')->first();
    
            // Find the user with ID 1
            $user = User::find(1);
    
            // Update the user's role
            if ($user && $adminRole) {
                $user->role_id = $adminRole->id;
                $user->save();
                
                return redirect()->route('admin.dashboard')->with('success', 'User with ID 1 is now an admin.');
            } else {
                return redirect()->route('admin.dashboard')->with('error', 'Failed to make user an admin.');
            }
        }
    }
