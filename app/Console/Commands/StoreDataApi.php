<?php

namespace App\Console\Commands;

use App\Http\Controllers\ApiController;
use Illuminate\Console\Command;

class StoreDataApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'StoreDataApi:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Salva as postagem da api reddit na base de dados local';

    private $apiController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiController = new ApiController();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->apiController->store()){
            echo "postagens cadastradas";
        }else{
            echo "algo inesperado aconteceu";
        }
    }
}
