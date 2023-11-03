<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Contact_type()
    {
        return $this->belongsTo(Contact_type::class);
    }

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
