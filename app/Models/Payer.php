<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    protected $guarded = ['id'];

    /**
     * Return the relation with table titles
     * 
     * @return \App\Models\Payer
     */
    public function titles()
    {
        return $this->hasMany(Title::class);
    }
}
