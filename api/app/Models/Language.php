<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LanguageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static LanguageFactory factory(...$parameters)
 * @method static Builder|Language first($columns = [])
 * @method static Builder|Language whereCode($value)
 */
class Language extends Model
{
    use HasFactory;

    public const UK = 'uk';
    public const RU = 'ru';
    public const EN = 'en';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
        'is_active',
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
}