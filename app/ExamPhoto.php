<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamPhoto extends Model
{
    public $table = 'exam_photos';

    public $fillable = [
        'exam_id',
        'photo',
    ];

    protected $casts = [
        'photo' => 'string',
        'exam_id' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'photo' => 'string',
        'exam_id' => 'string',
    ];
}
