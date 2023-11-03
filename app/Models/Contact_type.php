<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_type extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Contact()
    {
        return $this->hasMany(Contact::class);
    }

}
