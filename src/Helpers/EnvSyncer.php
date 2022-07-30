<?php
namespace OmeneJoseph\DynamicEnv\Helpers;

use Illuminate\Support\Env;

class EnvSyncer extends EnvHelperBase
{
    const ARN_KEY = 'SECRETS_ARN';

    public function syncSecrets(string $environment)
    {
        $envVariables = array_keys(invade(invade(Env::getRepository())->writer)->loaded);
        $secrets = [];

        foreach (($envVariables) as $variable) {

            if ($variable === 'APP_ENV') {
                $secrets[$variable] = $environment;
            } else {
                $value = env($variable);
                $secrets[$variable] = $value;
            }

        }

        $exists = $this->checkSecretExist($environment);

        if ($exists) {
            $this->client->putSecretValue([
                'SecretId' => $environment,
                'SecretString' => json_encode($secrets)
            ]);
        } else {
            $this->client->createSecret([
                'Name' => $environment,
                'SecretString' => json_encode($secrets)
            ]);
        }

    }
}
