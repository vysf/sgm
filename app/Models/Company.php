<?php

namespace App\Models;

use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Commitment;
use App\Models\KeyFeature;
use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aboutUs() {
        return $this->hasOne(AboutUs::class);
    }

    public function keyFeatures() {
        return $this->hasMany(KeyFeature::class);
    }

    public function commitment() {
        return $this->hasOne(Commitment::class);
    }

    public function contact() {
        return $this->hasOne(Contact::class);
    }

    public function socialMedias() {
        return $this->hasMany(SocialMedia::class);
    }
}
