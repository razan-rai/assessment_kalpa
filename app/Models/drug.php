<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drug extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'brand_name', 'verified_by', 'applicant_id', 'status', 'note', 'description', 'verifiyed_on'];

    public function user()
    {
        return $this->belongsTo(User::class,'applicant_id','id');
    }   
}
