<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrders extends Model
{
    protected $table = 'work_orders';
    protected $guarded = [];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id');
    }

    public function statusLogs()
    {
        return $this->hasMany(StatusLogs::class, 'work_order_id', 'id');
    }
}
