<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Brand extends Model
{
    use HasFactory, AsSource;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'image_path'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
