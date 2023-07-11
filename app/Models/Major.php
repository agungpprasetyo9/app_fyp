<?php

namespace App\Models;

use Dotenv\Repository\Adapter\GuardedWriter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'majors';

    protected $guarded = 'id';

    protected $fillable = [
        'major_name',
        'description'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'major_id');
    }


}
