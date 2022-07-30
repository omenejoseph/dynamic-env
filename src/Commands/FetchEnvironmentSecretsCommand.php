<?php

namespace OmeneJoseph\DynamicEnv\Commands;

use Illuminate\Console\Command;
use OmeneJoseph\DynamicEnv\Helpers\EnvPopulator;
use OmeneJoseph\DynamicEnv\Helpers\EnvSyncer;

class FetchEnvironmentSecretsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate application env from stored secrets in secret manager';

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
     * @return mixed
     */
    public function handle()
    {
        $environment = $this->choice('What environment are populating from? ', config('dynamic-env.environments'));

        $this->info("------- Starting populating env from $environment environment -----");

        (new EnvPopulator)->populate($environment, $this);

        $this->info("------- Population complete for $environment environment -----");
    }
}
