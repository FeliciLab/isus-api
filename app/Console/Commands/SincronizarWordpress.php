<?php

namespace App\Console\Commands;

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
    protected $description = 'Sincroniza api wordpress com a api-isus.';

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
        $sync = new WordpressSyncronizeService();
        $this->info('sincronizar:wordpress is running...\n');
        $sync->sync();
        $this->info('sincronizar:wordpress was executed successfully!\n');

        return 0;
    }
}
