<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $table = 'exams';

    public $fillable = [
        'class',
        'subject_id',
        'num_sentence',
        'exam_id',
    ];

    protected $casts = [
        'class' => 'string',
        'subject_id' => 'integer',
        'num_sentence' => 'integer',
        'exam_id' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'class' => 'string',
        'subject_id' => 'integer',
        'num_sentence' => 'integer',
        'exam_id' => 'string',
    ];
}
