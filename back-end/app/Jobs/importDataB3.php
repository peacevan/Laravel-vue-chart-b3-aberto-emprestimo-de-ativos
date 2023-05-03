<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\LedingOpenPositionController;
use Exception;
use Illuminate\Support\Facades\Http;
use Spatie\ArtisanDispatchable\Jobs\ArtisanDispatchable;


class importDataB3 implements ShouldQueue, ArtisanDispatchable
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  private $ledingOpenPosition;
  protected $startDate;

  //public function __construct(string $startDate = ' ', protected  string $endDate = 'xxx')
  public function __construct()
  {
    $startDate = date("d/m/Y");
    $this->startDate = $startDate;
    // $this->endDate   = $endDate;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {

    return  app('App\Http\Controllers\LedingOpenPositionController')->importDataB3();
  }

  function loadPeriodo($startDate, $endDate)
  {
    // Definir a data de início e fim
    $startDate = new \DateTime($startDate);
    $endDate = new \DateTime($endDate);
    // Definir um intervalo de 1 dia
    $interval = new \DateInterval('P1D');
    // Definir um período de datas usando a função DatePeriod
    $period = new \DatePeriod($startDate, $interval, $endDate);
    // Contar os dias úteis
    $workdays = 0;
    $listDiaUteis = array();
    foreach ($period as $date) {
      if ($date->format('N') < 6) { // Verificar se o dia da semana é de segunda a sexta-feira
        $workdays++;
        $this->importDataB3('', $date->format('d/m/Y'));
      }
    }
    echo "Total de dias úteis em maio de 2023: " . $workdays;
    return $listDiaUteis;
  }

  function validateData($dtini, $dtfim)
  {
    $data_inicial = strtotime($dtini);
    $data_final   = strtotime($dtfim);
    if ($data_inicial > $data_final) {
      echo "A data inicial é maior que a data final";
      return;
    }
  }
}
// php artisan import-data-b3 --startDate "teste" --endDate "teste"