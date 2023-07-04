<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    
    protected $fillable = [
        'user_id',
        'class_id',
        'name',
        'birth_date',
        'gender',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    } 
}
