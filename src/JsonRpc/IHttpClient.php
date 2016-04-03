<?php

namespace LetsAgree\GethJsonRpcPhpClient\JsonRpc;



interface IHttpClient
{

	/**
	 * @param string $body
	 * @return string
	 */
	public function post($body);

}
