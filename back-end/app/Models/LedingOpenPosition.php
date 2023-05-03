<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LedingOpenPosition extends Model
{

    protected $table = 'lending_open_position';
    protected $primaryKey = 'id_open_position';
    public $timestamps = false;
    protected $guarded = ['id_open_position'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            "RptDt",
            "TckrSymb",
            "Asst",
            "BalQty",
            "TradAvrgPric",
            "PricFctr",
            "BalVal"
    ];
}
    