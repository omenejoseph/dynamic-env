<?php

namespace Tests\Unit;

use OmeneJoseph\DynamicEnv\Helpers\EnvPopulator;
use PHPUnit\Framework\TestCase;

class DynamicEnvTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEnvVariablesAreProperlyPopulatedTest()
    {
        $secrets = new \stdClass();
        $keys = ['APP_ENV', 'APP_NAME', 'APP_KEY', 'APP_DEBUG'];

        foreach($keys as $key) {
            $secrets->{$key} = rand(10000, 30000);
        }

        (new EnvPopulator)
                ->setFilePaths(__DIR__.'/./env.checking', __DIR__.'/./.env.sync')
                ->setFetchedSecrets($secrets)
                ->handleEnvPathPopulation();

        $this->assertFileExists(__DIR__.'/./env.checking');

        $contents = file_get_contents(__DIR__.'/./env.checking');

        foreach ($keys as $secret) {
            $this->assertTrue(str_contains($contents, $secret));
        }

        unlink(__DIR__.'/./env.checking');
    }
}
