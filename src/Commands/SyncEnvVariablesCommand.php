<?php
namespace OmeneJoseph\DynamicEnv\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Env;
use OmeneJoseph\DynamicEnv\Helpers\EnvSyncer;

class SyncEnvVariablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync dynamic .env';

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
        $environment = $this->choice('What environment are you syncing for? ', config('dynamic-env.environments'));

        $this->info("------- Starting sync for $environment environment -----");

        (new EnvSyncer)->syncSecrets($environment);

        $this->info("------- Sync complete for $environment environment -----");
    }
}
