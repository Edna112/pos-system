<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_number',
        'title',
        'description',
        'amount',
        'expense_date',
        'category',
        'payment_method',
        'reference_number',
        'user_id',
        'status',
        'notes',
        'attachment',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function generateExpenseNumber(): string
    {
        $lastExpense = $this->orderBy('id', 'desc')->first();
        $number = $lastExpense ? intval(substr($lastExpense->expense_number, 3)) + 1 : 1;
        return 'EXP' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('expense_number', 'like', "%{$term}%")
                ->orWhere('title', 'like', "%{$term}%")
                ->orWhere('category', 'like', "%{$term}%")
                ->orWhere('status', 'like', "%{$term}%");
        });
    }
}
