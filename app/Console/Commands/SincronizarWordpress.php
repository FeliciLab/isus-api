<?php

namespace App\Console\Commands;

use App\Model\Estado;
use App\Service\WordpressSyncronizeService;
// Salvar o dado no DB
use Illuminate\Console\Command;

class SincronizarWordpress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sincronizar:wordpress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza api wordpress com esta api.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 'The command is running...\n';
        $sync = new WordpressSyncronizeService();
        // dd($sync->hello());
        // $sync->sync();
        Estado::create([
            'nome' => $sync->hello(),
            'uf' => 'ZZ',
        ]);

        echo 'The command was successful!\n';

        return 0;
    }
}
