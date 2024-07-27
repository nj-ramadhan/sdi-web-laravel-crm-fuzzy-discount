<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'id',
        'name',
        'join_date',
        'address',
        'total_transaction',
        'total_point',
        'grade',
    ];

    /**
     * transaction
     *
     * @return void
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
