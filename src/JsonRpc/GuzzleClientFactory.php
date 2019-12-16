<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient\JsonRpc;

use GuzzleHttp\Client as GuzzleHttpClient;

/* final */ class GuzzleClientFactory
{
    /**
     * @param string[] $options
     */
    public function create(array $options): GuzzleHttpClient
    {
        return new GuzzleHttpClient($options);
    }
}
