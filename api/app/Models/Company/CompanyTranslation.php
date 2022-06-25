<?php

declare(strict_types=1);

namespace App\Models\Company;

use App\Models\Language;
use Database\Factories\Company\CompanyTranslationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $company_id
 * @property string $language
 * @property string $title
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CompanyTranslationFactory factory(...$parameters)
 */
class CompanyTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'language',
        'title',
        'description',
        'meta_title',
        'meta_description',
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
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language');
    }
}
