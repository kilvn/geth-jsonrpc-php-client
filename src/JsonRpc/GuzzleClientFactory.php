<?php

namespace Achse\GethJsonRpcPhpClient\JsonRpc;

use GuzzleHttp\Client as GuzzleHttpClient;
use Nette\Object;



class GuzzleClientFactory extends Object
{

	/**
	 * @param string[] $options
	 * @return Client
	 */
	public function create(array $options)
	{
		return new GuzzleHttpClient($options);
	}

}
