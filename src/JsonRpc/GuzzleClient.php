<?php

namespace LetsAgree\GethJsonRpcPhpClient\JsonRpc;

use GuzzleHttp\Client;



class GuzzleClient implements IHttpClient
{

	private $client;



	/**
	 * @param string $url
	 * @param int $port
	 */
	public function __construct($url, $port)
	{
		$options = [
			'base_uri' => sprintf('%s:%d', $url, $port),
		];
		$this->client = new Client($options);
	}



	/**
	 * @inheritdoc
	 */
	public function post($body)
	{
		$response = $this->client->post('', ['body' => $body]);

		return $response->getBody()->getContents();
	}

}