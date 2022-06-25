<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Company\Company;
use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Laravel\Lumen\Auth\Authorizable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User query()
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject, CanResetPasswordInterface
{
    use Authenticatable, Authorizable, HasFactory, CanResetPasswordTrait, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
