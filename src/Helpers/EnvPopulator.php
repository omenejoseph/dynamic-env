<?php

namespace OmeneJoseph\DynamicEnv\Helpers;

use Illuminate\Console\Command;
use Illuminate\Support\Env;

class EnvPopulator extends EnvHelperBase
{
    public function populate(string $environment, Command $command)
    {
        $exists = $this->checkSecretExist($environment);

        $suffix = config('dynamic-env.env-suffix');
        $tempEnvPath = base_path(".env.$suffix");
        $currentEnvPath = base_path('.env');

        if (!$exists) {
            $command->info("Secrets do not exists for this environment");
        } else {

            if (file_exists($tempEnvPath)) {
                unlink($tempEnvPath);
            }

            $env = fopen(base_path('.env.sync'), 'w');

            foreach ($this->fetchedSecrets as $key => $secret) {
                fwrite($env, "{$key}={$secret}\n");
            }

            fclose($env);

            copy($tempEnvPath, $currentEnvPath);

            unlink($tempEnvPath);
        }
    }
}
