<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LanguageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $code
 * @property string $name
 * @method static LanguageFactory factory(...$parameters)
 * @method static Builder|Language first($columns = [])
 * @method static Builder|Language whereCode($value)
 */
class Language extends Model
{
    use HasFactory;

    public const UK = 'uk';
    public const EN = 'en';

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return static|Builder
     */
    public static function query(): Builder
    {
        return parent::query();
    }

    /**
     * @return string[]
     */
    public static function getSupportedLanguages(): array
    {
        return [
            self::UK => 'Українська',
            self::EN => 'English',
        ];
    }
}
