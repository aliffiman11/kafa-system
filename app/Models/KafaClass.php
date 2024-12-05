<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KafaClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_name'
    ];

    public function teacher()
    {
        return $this->belongsTo(teacher::class);
    }

    public function students()
    {
        return $this->hasMany(StudentClass::class, 'class_id', 'id');
    }
}
