<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function applicants() {
        return $this->belongsToMany('App\User','job__users')->withPivot('comment');
    }
}
