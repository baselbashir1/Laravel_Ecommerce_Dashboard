<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total_price', 'status', 'created_by', 'updated_by'];

    public function isPaid()
    {
        return $this->status === OrderStatus::Paid->value;
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function deleteUnpaidOrders($hours)
    {
        return Order::query()->where('status', OrderStatus::Unpaid->value)
            ->where('created_at', '<', Carbon::now()->subHours($hours));
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
