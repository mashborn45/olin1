<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
    ];

    public function materials() {
        return $this->hasMany(Material::class);
    }
    public function assessments() {
        return $this->hasMany(Assessment::class);
    }
    public function course() {
        return $this->belongsTo(Course::class);
    }

}
