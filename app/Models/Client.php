<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }
}
