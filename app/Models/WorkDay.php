<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDay extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'profession_id',
    ];

    protected $dates = ['deleted_at'];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
