<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolModel extends Model
{
    use HasFactory;

    protected $table = 'schools';

    protected $fillable = [
        'id',
        'name',
    ];
}
