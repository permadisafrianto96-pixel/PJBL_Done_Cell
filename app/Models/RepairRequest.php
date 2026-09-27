<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairRequest extends Model
{
    protected $fillable = [
        'user_id',
        'request_id',
        'customer_name',
        'phone',
        'brand',
        'model',
        'category',
        'damage_name',
        'description',
        'estimated_price_min',
        'estimated_price_max',
        'fixed_price',
        'status',
        'payment_method',
        'proof_file',
        'sender_bank',
        'account_holder',
        'account_number',
        'transfer_amount',
        'repair_date',
    ];

    protected $casts = [
        'estimated_price_min' => 'decimal:2',
        'estimated_price_max' => 'decimal:2',
        'fixed_price' => 'decimal:2',
        'transfer_amount' => 'decimal:2',
        'repair_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}