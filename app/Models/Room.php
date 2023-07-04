<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Room extends Model
{

    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'rooms';

    protected $fillable = [
        'room_name',
    ];

    public function students(){
        $this->hasMany(Student::class);
    }


}
