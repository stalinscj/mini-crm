<?php

namespace App\Models;

use App\Traits\SecureDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collaborator extends Model
{
    use HasFactory, SoftDeletes, SecureDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'name',
        'last_name',
        'email',
        'phone',
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
     * Get the company to which the collaborator belongs.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function company()
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }
}
