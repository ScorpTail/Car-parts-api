<?php

namespace App\Models;

use App\Casts\StatusProductCast;
use App\Enum\StatusProductEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function emptyDeletedAtRows(): bool
    {
        return isset($this->deleted_at);
    }
}
