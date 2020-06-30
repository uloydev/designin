<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceExtras;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'user_id', 'agent_id', 'package_id', 'started_at', 'status', 'progress', 'request', 'extras',
        'deadline', 'is_reviewed', 'budget', 'promo_id', 'attachment', 'quantity', 'max_revision', 'invoice_id'
    ];
    protected $casts = ['start_at' => 'datetime', 'deadline' => 'datetime'];

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

    public function result()
    {
        return $this->hasOne('App\ProjectResult')->where('type', 'result');
    }

    public function revision()
    {
        return $this->hasMany('App\ProjectResult')->where('type', 'revision');
    }

    public function promo()
    {
        return $this->belongsTo('App\Promo');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

}
