<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Employee extends Model
{
    use BelongsToThrough;

    protected $fillable = [
        'designation_id',
        'name',
        'phone',
        'email',
        'address',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function department()
    {
        return $this->belongsToThrough(Department::class, Designation::class);
    }

    public function company()
    {
        return $this->belongsToThrough(Company::class, [Designation::class, Department::class]);

    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function scopeInCompany($query)
    {
        return $query->whereHas('designation', fn($q) => $q->inCompany());
    }

    public function scopeSearchByName($query, $name)
    {
        if (!$name) {
            return $query;
        }
        return $query->whereRaw('name', 'like', '%' . strtolower($name) . '%');
    }

    public function getActiveContract($start_date = now(), $end_date = now())
    {
        return $this->contracts()->where('start_date', '<=', $start_date)->where('end_date', '>=', $end_date)->first();
    }

}
