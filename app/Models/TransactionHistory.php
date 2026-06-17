<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    protected $table = 'transaction_history';
    protected $fillable = [
        'professional_id',
        'amount',
        'transaction_id',
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }
}
