<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'professional_url',
        'photo_path',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }

    public function isAlumno(): bool
    {
        return !$this->is_admin;
    }

    public function phoneWithPrefix(): ?string
    {
        if (empty($this->phone)) {
            return null;
        }

        $prefix = config('app.whatsapp_prefix', '+54');
        $phone = preg_replace('/[0-9]/', '', $this->phone);

        return $prefix . $phone;
    }

    public function profilePhotoUrl(): string
    {
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }

        return asset('images/default-avatar.png');
    }
}
