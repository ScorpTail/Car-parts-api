<?php

namespace App\Models;

use App\Enum\StatusProductEnum;
use App\Casts\StatusProductCast;
use Database\Factories\CarPartFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Part extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['model_id', 'article', 'name', 'description', 'price', 'status'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => StatusProductCast::class,
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return CarPartFactory::new();
    }

    public function emptyDeletedAtRows(): bool
    {
        return isset($this->deleted_at);
    }
}
