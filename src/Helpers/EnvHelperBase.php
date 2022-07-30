<?php
namespace OmeneJoseph\DynamicEnv\Helpers;

use Aws\SecretsManager\Exception\SecretsManagerException;
use Aws\SecretsManager\SecretsManagerClient;

class EnvHelperBase
{
    protected SecretsManagerClient $client;

    protected \stdClass $fetchedSecrets;

    public function __construct()
    {
        $this->client = new SecretsManagerClient([
            'credentials' => [
                'key' => config('dynamic-env.aws_key'),
                'secret' => config('dynamic-env.aws_secret'),
            ],
            'version' => 'latest',
            'region' => config('dynamic-env.aws_secret_region'),
            'ForceOverwriteReplicaSecret' => true,
        ]);
    }

    protected function checkSecretExist(string $environment): bool
    {
        $exists = true;

        try {
            $response = $this->client->getSecretValue(['SecretId' => $environment]);
            $this->fetchedSecrets = json_decode($response['SecretString']);
        }catch (SecretsManagerException $exception) {
            $exists = false;
        }

        return $exists;
    }
}
