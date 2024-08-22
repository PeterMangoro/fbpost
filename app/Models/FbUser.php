<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FbUser extends Model
{
    use HasFactory;

    protected $fillable = ['fb_id','name','token'];

    public function pages():HasMany{
        return $this->hasMany(FbPage::class);
    }
    public function groups():HasMany{
        return $this->hasMany(FbGroup::class);
    }
}
