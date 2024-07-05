<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function detailTransaksis(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function requestions(): HasMany
    {
        return $this->hasMany(Requestion::class);
    }
    
    public function returneds(): HasMany
    {
        return $this->hasMany(Returned::class);
    }
    
    public function getCustomer($id)
    {
        return Customer::find($id)->code;
    }
}
