<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address',
        'country',
        'state',
    ];


    /**
     * Get the user that owns the phone.
     */
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
}
