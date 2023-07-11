<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable =[
        'decition',
        'student_id',
        'major_id'
    ];

    public function universities()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function majors()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }
}
