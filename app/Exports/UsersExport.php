<?php

namespace App\Exports;

use App\Models\AppUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users->map(function ($user) {
            return [
                'ID'     => $user->id,
                'Name'   => $user->name,
                'Email'  => $user->email,
                'Phone'  => $user->phone,
                'Status' => $user->status == 1 ? 'Active' : 'Inactive',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Phone', 'Status'];
    }
}
