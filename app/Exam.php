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
        'start_time',
        'end_time',
        'exam_id',
    ];

    protected $casts = [
        'class' => 'string',
        'subject_id' => 'integer',
        'num_sentence' => 'integer',
        'start_time' => 'date_format:y-m-d H:i:s',
        'end_time' => 'date_format:y-m-d H:i:s',
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
        'start_time' => 'date_format:y-m-d H:i:s',
        'end_time' => 'date_format:y-m-d H:i:s',
        'exam_id' => 'string',
    ];
}
