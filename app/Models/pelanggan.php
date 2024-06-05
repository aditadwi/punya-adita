<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class pelanggan extends Model
{
    use HasFactory;
    protected $fillable=['no','name','hp','alamat'];

    public function transaksi():HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
