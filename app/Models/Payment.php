<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','child_id','payment_type', 'remarks', 'payment_amount', 'payment_method', 'payment_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function child()
    {
        return $this->belongsTo(Student::class, 'child_ID');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'child_ID');
    }
}
