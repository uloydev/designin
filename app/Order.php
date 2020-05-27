<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceExtras;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'agent_id',
        'package_id',
        'started_at',
        'status',
        'progress',
        'request',
        'deadline',
        'is_reviewed',
        'budget',
        'promo_id',
        'attachment',
        'quantity',
        'max_revision',
        'duration',
        'extras'
    ];
    protected $casts = ['start_at' => 'datetime', 'deadline' => 'datetime'];
    // protected $with = ['package'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function results()
    {
        return $this->hasMany('App\ProjectResult');
    }

    public function promo()
    {
        return $this->belongsTo('App\Promo');
    }

    // public function extras()
    // {
    //     if (!empty(self::extras)) {
    //         $extras_id = json_decode(self::extras);
    //         return ServiceExtras::where('id', 'in', $extras_id)->get();
    //     }else {
    //         return NULL;
    //     }
    // }
}
