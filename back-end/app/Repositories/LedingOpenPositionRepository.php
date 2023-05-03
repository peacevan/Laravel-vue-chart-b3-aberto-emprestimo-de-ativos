<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\LedingOpenPosition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LedingOpenPositionRepository
{
    public function __construct()
    {
    }

    /**
     * @return LengthAwarePaginator
     */
    public static function index(): LengthAwarePaginator
    {
        return LedingOpenPosition::paginate();
    }

    /**
     * @return Collection
     */
    public static function findActiveIntensCompras($columns = ['id', 'name']): Collection
    {
        return LedingOpenPosition::active()
            ->get($columns);
    }

    /**
     * @return LedingOpenPositionRepository
     */
    public static function store($arrayLedingOpenPosition)
    {

        //  return  $arrayLedingOpenPosition;
        return LedingOpenPosition::create($arrayLedingOpenPosition);
    }

    /**
     * @return bool
     */
    public static function update($arrayLedingOpenPosition, $LedingOpenPosition): bool
    {
        return $LedingOpenPosition->update($arrayLedingOpenPosition);
    }

    /**
     * @return bool
     */
    public static function destroy($LedingOpenPosition): bool
    {
        return $LedingOpenPosition->delete();
    }

    public static function chartOpenPosition($request)
    {
        $request =  $request->all();

        $res=DB::table('lending_open_position')
           ->select(
                'Asst as ativo_papel',
                DB::raw('ROUND((sum(TradAvrgPric)/count(TradAvrgPric)), 2) as preco_medio')
            )
            ->groupBy('Asst')
            ->orderBy('Asst', 'desc')
            ->skip($request['page'])
            ->take($request['size']);
            if(array_key_exists('ativo',$request)&&($request['ativo']!=null)){
               
                $res->where('Asst',$request['ativo']);
            }
            return  $res->get();
    }

    public static function chartOpenPositionTotal()
    {
        return DB::table('lending_open_position')
            ->select(
                'Asst as ativo_papel',
                DB::raw('ROUND((sum(TradAvrgPric)/count(TradAvrgPric)), 2) as preco_medio')
            )
            ->groupBy('Asst')
            ->orderBy('Asst', 'desc')

            ->get();
    }
}
