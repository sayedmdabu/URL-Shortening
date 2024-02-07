<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickStatistic extends Model
{
    use HasFactory;
    
    protected $fillable = ['url_id', 'clicked_at'];

    public function url()
    {
        return $this->belongsTo(URL::class);
    }
}
