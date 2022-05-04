<?php

namespace App\Models;

use App\Traits\HasCan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Out extends Model
{
    use HasFactory;
    use HasCan;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'merk',
        'jumlah',
    ];

    protected $guards = [];

    protected $appends = [
        'can',
    ];

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y, H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y, H:i:s');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', '%' . $search . '%')
                    ->orWhere('kategori', 'like', '%' . $search . '%')
                    ->orWhere('merk', 'like', '%' . $search . '%')
                    ->orWhere('jumlah', 'like', '%' . $search . '%');
            });
        });
    }
    public function stocks()
    {
        return $this->belongsTo(Stock::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
