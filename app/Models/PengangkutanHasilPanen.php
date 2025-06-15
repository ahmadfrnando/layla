<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengangkutanHasilPanen extends Model
{
    use HasFactory;

    protected $table = 'pengangkutan_hasil_panen';
    protected $guarded = ['id'];


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->muatan_pabrik != null && $model->tandan_pabrik != null) {

                $model->muatan_hilang = $model->muatan_afdeling - $model->muatan_pabrik;
                $model->tandan_hilang = $model->tandan_afdeling - $model->tandan_pabrik;
                if ($model->muatan_hilang < 0) {
                    $model->muatan_hilang = 0;
                }
                if ($model->tandan_hilang < 0) {
                    $model->tandan_hilang = 0;
                } 
            }
        });
    }

    public function afdeling()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengangkutan()
    {
        return $this->belongsTo(Pengangkutan::class);
    }
}
