<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $table = 'exams';

    public $fillable = [
        'stt',
        'content',
        'ans_a',
        'ans_b',
        'ans_c',
        'ans_d',
        'subject_id',
        'exam_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'stt' => 'string',
        'content' => 'string',
        'ans_a' => 'string',
        'ans_b' => 'string',
        'ans_c' => 'string',
        'ans_d' => 'string',
        'subject_id' => 'integer',
        'exam_id' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'stt'     => 'string',
        'content' => 'string',
        'ans_a'   => 'string',
        'ans_b'   => 'string',
        'ans_c'   => 'string',
        'ans_d'   => 'string',
        'subject_id' => 'integer',
        'exam_id' => 'string',
    ];
}
