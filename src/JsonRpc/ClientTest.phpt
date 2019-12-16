<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient\JsonRpc;

require_once __DIR__ . '/../bootstrap.php';

use Mockery;
use Mockery\MockInterface;
use Tester\Assert;
use Tester\TestCase;

final class ClientTest extends TestCase
{
    public function testCall(): void
    {
        $httpClient = $this->mockIHttpClient();
        $httpClient->shouldReceive('post')->andReturn('{"jsonrpc":"2.0","id":1,"result":"0x16345785d8a0000"}');

        $client = new Client($httpClient);
        $result = $client->callMethod('eth_getBalance', ['0xf99ce9c17d0b4f5dfcf663b16c95b96fd47fc8ba', 'latest']);
        Assert::equal('0x16345785d8a0000', $result->result);
    }

    /**
     * @return IHttpClient&MockInterface
     */
    private function mockIHttpClient(): IHttpClient
    {
        return Mockery::mock(IHttpClient::class);
    }

    public function testFailUponIdChange(): void
    {
        $httpClient = $this->mockIHttpClient();
        $httpClient->shouldReceive('post')->andReturn('{"jsonrpc":"2.0","id":2,"result":"0x16345785d8a0000"}');

        $client = new Client($httpClient);

        Assert::exception(
            static fn () => $client->callMethod(
                'eth_getBalance',
                ['0xf99ce9c17d0b4f5dfcf663b16c95b96fd47fc8ba', 'latest']
            ),
            RequestFailed::class
        );
    }
}

(new ClientTest())->run();
