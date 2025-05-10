<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user')->withTimestamps();
    }
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    public function designations()
    {
        return $this->hasManyThrough(Designation::class, Department::class);
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/default-logo.png');
    }



}
