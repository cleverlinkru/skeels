<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'time',
        'image_id',
        'work_day_id',
    ];

    protected $dates = ['deleted_at'];

    public function image()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function work_day()
    {
        return $this->belongsTo(WorkDay::class);
    }
}
