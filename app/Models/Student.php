<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'parents_id'
    ];

    public function mark()
    {
        return $this->hasOne(StudentResult::class);
    }

    public function parents()
    {
        return $this->belongsTo(Parents::class);
    }


    public function parent()
    {
        return $this->belongsTo(User::class, 'parents_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'child_id');
    }
}
