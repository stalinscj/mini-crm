<?php

namespace App\Models;

use App\Traits\SecureDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, SoftDeletes, SecureDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'website',
    ];

    /**
     * Set the company's email.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Set the company's website.
     *
     * @param  string  $value
     * @return void
     */
    public function setWebsiteAttribute($value)
    {
        $this->attributes['website'] = strtolower($value);
    }

    /**
     * Get the collaborators for the company.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collaborators()
    {
        return $this->hasMany(Collaborator::class);
    }
}
