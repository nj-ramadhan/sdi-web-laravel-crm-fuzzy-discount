<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_time',
        'customer_id',
        'customer_name',
        'point',
        'amount_transaction'
    ];

    /**
     * customer
     *
     * @return void
     */
    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
    
}
