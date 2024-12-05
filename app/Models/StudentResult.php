<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    use HasFactory;

    protected $table = 'student_results';

    protected $fillable = [
        'Students_id',
        'Subject_id',
        'name',	
        'className',
        'AmaliSolatMarks',
        'PenghayatanMarks',
        'TilawahMarks',
        'PelajaranJawiMarks',
        'SirahMarks',	
        'UlumMarks',	
        'AdabMarks',	
        'LughahMarks'	
    ];

    public function stdmark() {
        return $this->belongsTo(Student::class);
    }
        
}
