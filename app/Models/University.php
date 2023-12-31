<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_name',
        'tightness',
    ];

    public function major()
    {
        return $this->hasOne(Major::class, 'university_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'university_id');
    }

}
