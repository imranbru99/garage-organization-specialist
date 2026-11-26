<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrder extends Model
{
    protected $table = 'work_orders';

    protected $fillable = [
        'job_number', 'customer_id', 'assigned_to', 'title', 'description', 'status',
        'priority', 'scheduled_start', 'scheduled_end', 'estimated_value', 'actual_value', 'address',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_start' => 'date',
            'scheduled_end' => 'date',
            'estimated_value' => 'decimal:2',
            'actual_value' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'work_order_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'work_order_id');
    }
}
