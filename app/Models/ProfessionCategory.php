<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfessionCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image_id',
    ];

    protected $dates = ['deleted_at'];

    public function image()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function professions()
    {
        return $this->belongsToMany(Profession::class);
    }
}
