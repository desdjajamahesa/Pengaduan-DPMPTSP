<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactOption extends Model
{
    use HasFactory;
    protected $table = 'contact_options';
    protected $fillable = ['type', 'value'];
}
