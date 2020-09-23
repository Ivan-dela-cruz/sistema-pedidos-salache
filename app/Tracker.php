<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tracker extends Model
{
    public $attributes = ['hits' => 0];

    protected $fillable = ['ip', 'date'];

    protected $table = 'trackers';

    public static function boot() {
        // When a new instance of this model is created...
        parent::boot();
        static::creating(function ($tracker) {
            $tracker->hits = 0;
        } );

        // Any time the instance is saved (create OR update)
        static::saving(function ($tracker) {
            $tracker->visit_date = Carbon::now(env("APP_TIMEZONE"))->format('Y-m-d');
            $tracker->visit_time = Carbon::now(env("APP_TIMEZONE"))->format('H:i:s');
            $tracker->hits++;
        } );
    }

    // Fill in the IP and today's date
    public function scopeCurrent($query) {
        return $query->where('ip', $_SERVER['REMOTE_ADDR'])
                     ->where('date', Carbon::now(env("APP_TIMEZONE"))->format('Y-m-d'));
    }

    public static function hit() {
        static::firstOrCreate([
                  'ip'   => $_SERVER['REMOTE_ADDR'],
                  'date' => Carbon::now(env("APP_TIMEZONE"))->format('Y-m-d'),
              ])->save();
    }
}
