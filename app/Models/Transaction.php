<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'date_transaction', 'amount', 'note', 'image'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeIncomes($query)
    {
        return $query->whereHas("category", fn ($query) => $query->where('flow', "pemasukkan"));
    }

    public function scopeExpenses($query)
    {
        return $query->whereHas("category", fn ($query) => $query->where('flow', "pengeluaran"));
    }
}
