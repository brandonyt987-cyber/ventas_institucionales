<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = User::where('role', 'cliente')
                        ->where('id', '!=', auth()->id())
                        ->paginate(10);
        
        return view('vendedor.clientes', compact('clientes'));
    }
}