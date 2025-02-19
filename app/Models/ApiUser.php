<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ApiUser extends Authenticatable
{
    use Notifiable;

    // Your existing model code
}
