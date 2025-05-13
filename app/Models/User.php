<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasRole;
use App\Models\Traits\LogsActivity;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRole, LogsActivity;

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Vztah k objednávkám uživatele
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in([self::ROLE_USER, self::ROLE_ADMIN])],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function updateRules(User $user)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in([self::ROLE_USER, self::ROLE_ADMIN])],
            'is_active' => ['required', 'boolean'],
        ];
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->logActivity('create', 'Vytvořen nový uživatel', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
            ]);
        });

        static::updated(function ($user) {
            $user->logActivity('update', 'Upraven uživatel', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'is_active' => $user->is_active,
            ]);
        });

        static::deleted(function ($user) {
            $user->logActivity('delete', 'Smazán uživatel', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
            ]);
        });
    }
}
