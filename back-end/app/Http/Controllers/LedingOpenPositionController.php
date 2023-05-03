<?php

namespace App\Http\Controllers;

use App\Http\Requests\LedingOpenPositionRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\LedingOpenPositionResource;
use App\Models\LedingOpenPosition;
use App\Services\LedingOpenPositionService;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\FORCE_IP_RESOLVE;
use GuzzleHttp\DECODE_CONTENT;
use GuzzleHttp\CONNECT_TIMEOUT;
use GuzzleHttp\READ_TIMEOUT;
use GuzzleHttp\TIMEOUT;


class LedingOpenPositionController extends Controller
{
    /**
     * Return initialization page data
     *
     * @return  \Illuminate\Http\Response
     */

    private $ledingService;


    public function __construct(LedingOpenPositionService $ledingOpenPositionService)
    {
        $this->ledingService = $ledingOpenPositionService;
    }
    public function initialize()
    {
        $LedingService = new LedingOpenPositionService();
        $LedingService = $LedingService->initialize();

        return LedingOpenPositionResource::collection($LedingService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $LedingService = new LedingOpenPositionService();
        $leding = $this->ledingService->index();
        return LedingOpenPositionResource::collection($leding);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LedingOpenPositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $arrayRequest[] = $request->all();
        $result = $this->formatRequest($arrayRequest);
        $LedingRequet = new \Illuminate\Http\Request;
        $LedingRequet->setMethod('POST');
        $LedingRequet->merge($result);
        foreach ($LedingRequet->all() as $value) {
            $leding = $this->ledingService->store($value);
        };
        return $leding;
        return new LedingOpenPositionResource($leding);
    }


    public function storeLending($arrayRequest)
    {

        //  $result = $this->formatRequest($arrayRequest);
        $LedingRequet = new \Illuminate\Http\Request;
        $LedingRequet->setMethod('POST');
        $LedingRequet->merge($arrayRequest);
        $leding=null;
        foreach ($LedingRequet->all() as $value) {
          // if(!empty($value)){
            $leding = $this->ledingService->store($value);
         //  }
           
        };
        return $leding;
        return new LedingOpenPositionResource($leding);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LedingOpenPosition  $leding
     * @return \Illuminate\Http\Response
     */
    public function show(LedingOpenPosition $leding)
    {
        return new LedingOpenPositionResource($leding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LedingOpenPositionRequest  $request
     * @param  \App\Models\LedingOpenPosition  $leding
     * @return \Illuminate\Http\Response
     */
    public function update(LedingOpenPositionRequest $request, LedingOpenPosition $leding)
    {
        $LedingService = new LedingOpenPositionService();
        $updated = $LedingService->update($request->validated(), $leding);

        if ($updated) {
            return new LedingOpenPositionResource($leding);
        }
        return response()->json([], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LedingOpenPosition  leding
     * @return \Illuminate\Http\Response
     */
    public function destroy(LedingOpenPosition $leding)
    {
        $LedingOpenPositionService = new LedingOpenPositionService();
        $LedingOpenPositionService->destroy($leding);
        return response()->json("DELETED", 204);
    }

    function formatRequest($arrayRequest)
    {
        $this->storegeFile("storage/app/public/", 'lendingOpen3.json', $arrayRequest);
        $result = array();
        foreach ($arrayRequest[0]['columns'] as $i => $col) {
            foreach ($arrayRequest[0]['values']  as $j => $value) {
                $result[$j][$col['name']] = $value[$i];
            }
        }
        return $result;
    }


    function importDataB3()
    {
        echo ('Aguarde:');
        try {
            $businessDayList = $this->twentyBusinessDaysAgo();
            $page = 1;


            foreach ($businessDayList as $diaUteis) {
                echo ('.');
                $res[$diaUteis] = $this->loadPages($diaUteis, $page);   //$this->importDataB3('', $dia);

            }

            $this->storegeFile($url = "storage/app/public/",'lendingOpen.json', $res);  //grava json 
        } catch (\Exception $e) {
            echo ($e->getMessage());
        }
        echo ('Operação Completada.');
    }
    /**
     * faz um loop na paginação 
     */
    function loadPages($dia, $page)
    {
        $res = array();
        $pageCount = null;
        do {
           echo('.');
            $url         = "https://arquivos.b3.com.br/tabelas/table/LendingOpenPosition/$dia/$page";
            $response    = $this->getData($url);
            if (($pageCount == null) && ($response != Null)) {
                $pageCount = array_key_exists('pageCount', $response) ? $response['pageCount'] : null;
            }
            $resp[0] =  $response;
            $page++;
            $resFormated   = $this->formatRequest($resp);
            $this->storeLending($resFormated);
            $res[] = $resFormated;
        } while ($page < $pageCount);
        return $res;
    }

    public  function getData($url)
    {

        $client = new Client();
        $options = [
            'http_errors' => true,
            'force_ip_resolve' => 'v4',
            'connect_timeout' => 120,
            'read_timeout' => 120,
            'timeout' => 120,
        ];
        $result   = $client->request('GET', $url, $options);
        $result   = $result->getBody();
        $result  = json_decode($result, true);
        return $result;
    }

    function storegeFile($url = "storage/app/public/", $filename = 'lendingOpen3.json', $data = null)
    {

        try {
            $file   = 'lendingOpen2.json';
            $result = file_put_contents($url . $filename, json_encode($data));
        } catch (\Exception $e) {
            echo ($e->getMessage());
        }
    }

    /**
     * obtem  os utimos 20 dias  ultei apartir da data atual
     */
    function twentyBusinessDaysAgo()
    {
        $current_date = date('Y-m-d');

        $twenty_business_days_ago = strtotime('-5 weekdays', strtotime($current_date));
        $business_days = array();
        for ($i = $twenty_business_days_ago; $i <= strtotime($current_date); $i = strtotime('+1 weekday', $i)) {
            $business_days[] = date('Y-m-d', $i);
        }
        return $business_days;
    }

    public function chartOpenPosition(Request $request){

       $LedingOpenPositionService = new LedingOpenPositionService();
       $res= $LedingOpenPositionService->chartOpenPosition($request); 

       $res= json_decode($res,true);
       foreach ($res  as $value){
       
            $chart[]=array(
              "columns"=>$value['ativo_papel'],
              "value"=>$value['preco_medio'],
             
            );
        }
        if(array_key_exists('ativo',$request->all())&&($request['ativo']!=null)){
            $chart["totalledings"]= 1;  
       }else{
           
            $chart["totalledings"]= sizeof(json_decode($LedingOpenPositionService->chartOpenPositionTotal())); 
   
            
        }
        return $chart; 
    }
}
