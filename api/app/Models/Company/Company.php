<?php

namespace App\Models\Company;

use App\Models\User;
use Database\Factories\Company\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static CompanyFactory factory(...$parameters)
 */
class Company extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slogan',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CompanyTranslation::class);
    }
}
