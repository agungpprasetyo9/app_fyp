<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'student_id',
        'subject_id',
        'tryout_id',
        'value',
    ];
}
