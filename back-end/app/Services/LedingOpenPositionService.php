<?php

namespace App\Services;

use App\Repositories\LedingOpenPositionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\LedingOpenPosition;


class LedingOpenPositionService
{
    /**
     * Return initialization page data
     *
     * @return Object
     */
    public function initialize(): Object
    {
        // Your code

        return new \stdClass();
    }

    /**
     * Displays a resource's list
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return LedingOpenPositionRepository::index();
    }

    /**
    * Get only active resources
    *
    * @return Collection
    */
    public function findActiveIntensCompras(): Collection
    {
        return LedingOpenPositionRepository::findActiveIntensCompras();
    }

    /**
     * Store a new resource in storage
     *
     * @param \App\Http\Requests\LedingOpenPosition  $request
     * @return LedingOpenPosition
     */
    public function store(array $request)
    {


        return LedingOpenPositionRepository::store($request);
    }

    /**
     * Update an specific resource in storage.
     *
     * @param \App\Http\Requests\IntensCompraRequest  $request
     * @param \App\Models\IntensCompra  $intensCompra
     * @return bool
     */
    public function update(array $request, $intensCompra): bool
    {
        return LedingOpenPositionRepository::update($request, $intensCompra);
    }

    /**
     * Delete an specific resource from storage.
     *
     * @param \App\Models\IntensCompra  $intensCompra
     * @return bool
     */
    public function destroy($intensCompra): bool
    {
        return LedingOpenPositionRepository::destroy($intensCompra);
    }

    public function chartOpenPosition($request){
        return LedingOpenPositionRepository::chartOpenPosition($request); 
    }

    public function chartOpenPositionTotal(){
        return LedingOpenPositionRepository::chartOpenPositionTotal(); 
    }


}
