<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Contact;
use App\Models\Countries;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View {
        
        $isSuperAdmin = auth()->user()->hasRole('superadmin');
        
        $contacts = Contact::all();
        $countries = Countries::all();

        return view('dashboard.index', [
            'contacts' => $contacts->count(),
            'countries' => $countries->count(),
            'isSuperAdmin' => $isSuperAdmin
        ]);
    }
}
