<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use App\Models\Vehiculo; // si tu modelo tiene otro nombre, dime y lo ajusto
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // ADMIN → contar usuarios que NO sean admin
        if ($user->hasRole('administrador')) {
            $usuariosRegistrados = User::role('vendedor')->count(); 
            return view('dashboard', [
                'usuarios' => $usuariosRegistrados,
                'vista' => 'administrador'
            ]);
        }
    }
}
