<?php

namespace LetsAgree\GethJsonRpcPhpClient\Tests\Unit\JsonRpc;

require_once __DIR__ . '/../../bootstrap.php';

use LetsAgree\GethJsonRpcPhpClient\JsonRpc\Client;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\IHttpClient;
use Mockery;
use Mockery\MockInterface;
use Tester\Assert;
use Tester\TestCase;



class ClientTest extends TestCase
{

	public function testCall()
	{
		$httpClient = $this->mockIHttpClient();
		$httpClient->shouldReceive('post')->andReturn('{"jsonrpc":"2.0","id":1,"result":"0x16345785d8a0000"}');

		$client = new Client($httpClient);
		$result = $client->callMethod('eth_getBalance', ['0xf99ce9c17d0b4f5dfcf663b16c95b96fd47fc8ba', 'latest']);
		Assert::equal('0x16345785d8a0000', $result);
	}



	/**
	 * @throws \LetsAgree\GethJsonRpcPhpClient\JsonRpc\RequestFailedException
	 */
	public function testFailUponIdChange()
	{
		$httpClient = $this->mockIHttpClient();
		$httpClient->shouldReceive('post')->andReturn('{"jsonrpc":"2.0","id":2,"result":"0x16345785d8a0000"}');

		$client = new Client($httpClient);
		$client->callMethod('eth_getBalance', ['0xf99ce9c17d0b4f5dfcf663b16c95b96fd47fc8ba', 'latest']);
	}



	/**
	 * @return IHttpClient|MockInterface
	 */
	private function mockIHttpClient()
	{
		return Mockery::mock(IHttpClient::class);
	}

}



(new ClientTest())->run();
