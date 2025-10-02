<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * Update the admin profile information.
     *
     * @param array $data
     * @return void
     */
    public function updateProfile(array $data): void
    {
        if (isset($data['username'])) {
            $this->username = $data['username'];
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $this->password = $data['password'];
        }

        $this->save();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Mutator to hash the password into the password_hash column.
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password_hash'] = Hash::make($value);
    }

    /**
     * Ensure the authentication system reads the correct password column.
     */
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }
}
