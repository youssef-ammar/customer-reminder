<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'customer_id',
        'date',


    ];

    public function users()
    {
        return $this->belongsToMany(User::class);

    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customers', 'id');
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class);
    }

}
