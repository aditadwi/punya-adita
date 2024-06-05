<?php

namespace App\Models;

use App\Http\Controllers\KudapanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detiltransaksi extends Model
{
    protected $fillable=['transaksi_id','kudapan_id','jumlah','harga'];
    use HasFactory;

    public function transaksi():BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function kudapan():BelongsTo
    {
        return $this->belongsTo(Kudapan::class);
    }
}
