<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCan;

class Kategori extends Model
{
    use HasFactory;
    use HasCan;

    protected $fillable = [
     'kategori',
    ];

    protected $guarded = ['id'];

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
                $query->where('kategori', 'like', '%' . $search . '%');
            });
        });
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function incomings()
    {
        return $this->hasMany(Incoming::class);
    }
    public function outs()
    {
        return $this->hasMany(Out::class);
    }

}
