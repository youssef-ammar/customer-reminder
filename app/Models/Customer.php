<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'name',
        'note',
        'date_execution_note',

    ];
    public function history()
    {
        return $this->belongsToMany(History::class);
    }
}
