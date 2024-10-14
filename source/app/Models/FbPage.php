<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbPage extends Model
{
    use HasFactory;

    protected $fillable = ['access_token','category','name','page_id','fb_user_id'];

    public function user(){
        return $this->belongsTo(FbUser::class);
    }
}
