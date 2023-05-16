<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }



    protected $casts = [
        'id' => 'string'
    ];
    public function getCategory(): HasOne
    {
        return $this->hasOne(Categories::class, "category_id");
    }
}
