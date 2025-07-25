<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function plan() 
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
