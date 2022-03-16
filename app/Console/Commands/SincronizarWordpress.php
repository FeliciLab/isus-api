<?php

namespace App\Console\Commands;

use App\Service\WordpressSyncronizeService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Throwable;

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
        try {
            $sync = new WordpressSyncronizeService();
            $this->info('sincronizar:wordpress is running...');
            $sync->sync();
            $this->info('sincronizar:wordpress was executed successfully! ' . Carbon::now());
        } catch (Throwable $e) {
            $this->error('sincronizar:wordpress error: ' . $e->getMessage());
        }

        return 0;
    }
}
