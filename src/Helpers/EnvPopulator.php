<?php

namespace OmeneJoseph\DynamicEnv\Helpers;

use Illuminate\Console\Command;
use Illuminate\Support\Env;

class EnvPopulator extends EnvHelperBase
{
    protected string $tempEnvPath;
    protected string $currentEnvPath;

    public function populate(string $environment, Command $command)
    {
        $exists = $this->checkSecretExist($environment);

        $suffix = config('dynamic-env.env-suffix');
        $this->tempEnvPath = base_path(".env.$suffix");
        $this->currentEnvPath = base_path('.env');

        if (!$exists) {
            $command->info("Secrets do not exists for this environment");
        } else {

            $this->handleEnvPathPopulation();
        }
    }

    public function setFilePaths(string $current, string $temp): self
    {
        $this->currentEnvPath = $current;
        $this->tempEnvPath = $temp;

        return $this;
    }

    public function setFetchedSecrets(\stdClass $secrets): self
    {
        $this->fetchedSecrets = $secrets;

        return $this;
    }

    public function handleEnvPathPopulation()
    {
        if (file_exists($this->tempEnvPath)) {
            unlink($this->tempEnvPath);
        }

        $env = fopen($this->tempEnvPath, 'w');

        foreach ($this->fetchedSecrets as $key => $secret) {
            fwrite($env, "{$key}={$secret}\n");
        }

        fclose($env);

        copy($this->tempEnvPath, $this->currentEnvPath);

        unlink($this->tempEnvPath);
    }
}
