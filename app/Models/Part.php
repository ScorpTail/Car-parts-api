<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use App\Enum\StatusProductEnum;
use App\Casts\StatusProductCast;
use Database\Factories\CarPartFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Attachment\Attachable;

class Part extends Model
{
    use AsSource, HasFactory, Attachable;

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
    protected $fillable = [
        'model_id',
        'article',
        'name',
        'description',
        'price',
        'status',
        'image_path'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => StatusProductCast::class,
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'part_id', 'user_id');
    }

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
