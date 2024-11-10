<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CourseCertificate extends Model
{
    use HasFactory;
    protected $table = 'courses_certificates';

    protected $fillable = [
        'certify_code',
        'student_fullname',
        'student_curp',
        'course_name',
        'course_hour_load',
        'issue_date',
        'instructor_name',
        'collaborator_id'
    ];
    

    public function getUrlPathAttribute(){
        return Storage::url($this->certify_path);
    }

}
