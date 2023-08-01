<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image_id',
        'salary',
        'salary_up',
        'salary_down',
        'popularity',
        'demand',
        'perspective',
        'demand_change',
    ];

    protected $dates = ['deleted_at'];

    public function image()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProfessionCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function work_days()
    {
        return $this->hasMany(WorkDay::class);
    }
}
