<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient\JsonRpc;

require_once __DIR__ . '/../bootstrap.php';

use GuzzleHttp\Client as GuzzleHttpClient;
use Tester\Assert;
use Tester\TestCase;

final class GuzzleClientFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $factory = new GuzzleClientFactory();
        Assert::type(GuzzleHttpClient::class, $factory->create([]));
    }
}



(new GuzzleClientFactoryTest())->run();
