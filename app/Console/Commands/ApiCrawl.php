<?php

namespace App\Console\Commands;

use App\Services\Facades\Ghibli;
use App\Services\Facades\PeopleFilm;
use Illuminate\Console\Command;

class ApiCrawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta os Filmes da API Studio Ghibli';

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
        $this->comment('Processing...');
        $this->comment('Please wait!!!');
        $this->comment(
            PeopleFilm::save(
                Ghibli::get()
            )
        );
    }
}
