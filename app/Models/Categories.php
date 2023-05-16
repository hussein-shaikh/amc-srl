<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    protected $guarded = ["id"];

    protected $casts = [
        'id' => 'string'
    ];

    public function getProducts()
    {
        return $this->hasMany(Products::class);
    }
}
