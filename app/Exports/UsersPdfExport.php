<?php

namespace App\Exports;

use App\Models\AppUser;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class UsersPdfExport implements FromView
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function view(): View
    {
        return view('userpdf', ['users' => $this->users]);
    }
}
