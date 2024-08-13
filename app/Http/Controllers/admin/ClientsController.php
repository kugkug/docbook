<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Patient;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index() {
        $clients = Patient::orderBy('firstname')->paginate(10);

        $data = [
            'title' => 'Clients',
            'header' => 'Clients',
            'clients' => $clients
        ];
        return view("admin.clients.index", $data);
    }
}
