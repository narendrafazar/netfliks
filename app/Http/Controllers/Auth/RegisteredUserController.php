<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user'); // Assign the 'user' role to the newly registered user   
        // Optionally, you can assign other roles or permissions here
        // If you have a default role, you can assign it like this:
        // $user->assignRole('default_role_name');
        // If you want to assign multiple roles, you can do it like this:
        // $user->syncRoles(['role1', 'role2']);    
        // If you want to assign permissions, you can do it like this:
        // $user->givePermissionTo('permission_name'); 
        // If you want to assign multiple permissions, you can do it like this:
        // $user->syncPermissions(['permission1', 'permission2']);
        // If you want to assign roles and permissions at the same time, you can do it like this:
        // $user->syncRoles(['role1', 'role2'])->givePermissionTo(['permission1', 'permission2']);  
        // If you want to assign roles and permissions from a collection, you can do it like this:
        // $roles = Role::whereIn('name', ['role1', 'role2'])->get();
        // $permissions = Permission::whereIn('name', ['permission1', 'permission2'])->get();
        // $user->syncRoles($roles)->syncPermissions($permissions); 
        // If you want to assign roles and permissions from a model, you can do it like this:
        // $role = Role::findByName('role_name');
        // $permission = Permission::findByName('permission_name');
        // $user->assignRole($role)->givePermissionTo($permission); 
        // If you want to assign roles and permissions from a model collection, you can do it like this:
        // $roles = Role::whereIn('name', ['role1', 'role2'])->get();
        // $permissions = Permission::whereIn('name', ['permission1', 'permission2'])->get();
        // $user->syncRoles($roles)->syncPermissions($permissions);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
