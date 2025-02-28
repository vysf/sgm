<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'commitment_list' => 'json'
    ];

    public function getCommitmentListAttribute($value)
    {
        // dd($value);
        return json_decode($value, true);
    }
}
