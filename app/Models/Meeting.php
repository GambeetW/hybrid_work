<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['guest_name', 'guest_email', 'starts_at', 'ends_at', 'comments', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setStartsAtAttribute($input){
        $this->attributes['starts_at'] = Carbon::createFromFormat('m/d/Y g:i A', $input)->format('Y-m-d H:i:s');
    }

    public function setEndsAtAttribute($input){
        $this->attributes['ends_at'] = Carbon::createFromFormat('m/d/Y g:i A', $input)->format('Y-m-d H:i:s');
    }

    public function setUserIdAttribute($input) {
        $this->attributes['user_id'] = auth()->user()->id;
    }
}
