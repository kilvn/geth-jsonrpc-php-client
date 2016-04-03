<?php

namespace LetsAgree\GethJsonRpcPhpClient\Tests\Integration\JsonRpc;

require_once __DIR__ . '/../../bootstrap.php';

use LetsAgree\GethJsonRpcPhpClient\JsonRpc\Client;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\GuzzleClient;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\GuzzleClientFactory;
use Tester\Assert;
use Tester\TestCase;



class ClientTest extends TestCase
{

	public function testCall()
	{
		$httpClient = new GuzzleClient(new GuzzleClientFactory(), 'localhost', 8545);
		$client = new Client($httpClient);
		$result = $client->callMethod('eth_getBalance', ['0xf99ce9c17d0b4f5dfcf663b16c95b96fd47fc8ba', 'latest']);
		Assert::equal('0x16345785d8a0000', $result);
	}

}



(new ClientTest())->run();
