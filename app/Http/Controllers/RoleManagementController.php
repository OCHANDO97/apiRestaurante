<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleManagementController extends Controller
{

    function createRole(Request $request)  {
        
        // $role = Role::create(['name'=> $request->name]);
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'api', // Especifica el guard 'web'
        ]);
        return response()->json([
            'message' => 'rol creado',
            'data' => $role]);
    }

    function asignaRole(Request $request)  {

        $user = User::find($request->input('idUsuario'));
        $role = Role::find($request->input('id'));
        $user->assignRole($role);
        
        return response()->json([
            'message' => 'rol asignado'
        ]);
    }

}
