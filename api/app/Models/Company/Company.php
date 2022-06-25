<?php

namespace App\Models\Company;

use App\Models\User;
use Database\Factories\Company\CompanyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $number_of_employees
 * @property string $slug
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CompanyFactory factory(...$parameters)
 * @method Builder|self filterByUser(string|int|User $user)
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
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static fn (self $model) => $model->created_at = $model->freshTimestamp());
    }

    /**
     * @return static|Builder
     */
    public static function query(): Builder
    {
        return parent::query()->with(['translations']);
    }

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

    /**
     * @param Builder $builder
     * @param string|int|User $user
     * @return Builder
     */
    protected function scopeFilterByUser(Builder $builder, string|int|User $user): Builder
    {
        if ($user instanceof User || is_numeric($user)) {
            $builder->where('user_id', $user instanceof User ? $user->id : (int)$user);
        } else {
            $builder->whereHas('user', static function (Builder|User $builder) use ($user): void {
                $builder->where('email', $user->email);
            });
        }

        return $builder;
    }
}
