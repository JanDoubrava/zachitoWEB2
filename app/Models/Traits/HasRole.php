<?php

namespace App\Models\Traits;

trait HasRole
{
    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    public static function getRoles(): array
    {
        return [
            self::ROLE_USER => 'Uživatel',
            self::ROLE_ADMIN => 'Administrátor',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role !== null && $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role !== null && $this->role === self::ROLE_USER;
    }
} 