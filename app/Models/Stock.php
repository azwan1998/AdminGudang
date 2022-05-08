<?php

namespace App\Models;


use App\Traits\HasCan; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    use HasCan;

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'merk',
        'jumlah',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
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
                $query->where('nama_barang', 'like', '%' . $search . '%');
                    // ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        });
    }
    public function incoming()
    {
        return $this->hasMany(Incoming::class);
    }
    public function out()
    {
        return $this->hasMany(Out::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
