<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getImageLinkAttribute()
    {
        return asset('uploads/portofolio/' . $this->image);
    }

    /**
     * Scope a query to only include 
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('user_id', Auth::id())
            ->where('status', 1);
    }
}
