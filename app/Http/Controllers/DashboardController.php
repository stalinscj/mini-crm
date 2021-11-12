<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Collaborator;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersCount         = User::count();
        $companiesCount     = Company::count();
        $collaboratorsCount = Collaborator::count();

        return view('dashboard.index', compact('usersCount', 'companiesCount', 'collaboratorsCount'));
    }
}
