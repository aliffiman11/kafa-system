<?php

namespace App\Models;
use Illuminate\Support\Str;
use App\Models\Kafa_class;
use App\Models\Subject;
use App\Models\teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $table = 'timetables';

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'weekday',
        'start_time',
        'end_time',
        'year',
    ];

    public function timetable() {
        return $this->belongsTo(Timetable::class);
    }

    public function class(){
        return $this->belongsTo(KafaClass::class, 'class_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher(){
        return $this->belongsTo(teacher::class, 'teacher_id');
    }
}
