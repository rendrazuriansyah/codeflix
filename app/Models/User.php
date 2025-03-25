<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the user's memberships.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Membership>
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Check if the user has an active membership plan.
     *
     * @return bool True if the user has an active membership plan, false otherwise.
     */
    public function hasMembershipPlan()
    {
        return $this->memberships()
            ->where('active', '=', true)
            ->where('end_date', '>', now())
            ->exists();
    }
}
