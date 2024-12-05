<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'description',
        'start_at',
        'end_at',
        'date'
    ];

    public function class()
    {
        return $this->belongsTo(KafaClass::class, 'class_id');
    }
}
