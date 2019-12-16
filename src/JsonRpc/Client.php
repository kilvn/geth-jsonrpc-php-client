<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient\JsonRpc;

use Nette\Utils\Json;
use stdClass;
use function array_values;
use function assert;
use function sprintf;

final class Client
{
    private const JSON_RPC_VERSION = '2.0';

    private string $jsonRpcVersion;

    private IHttpClient $client;

    private int $id;

    public function __construct(IHttpClient $client, string $jsonRpcVersion = self::JSON_RPC_VERSION)
    {
        $this->client = $client;
        $this->jsonRpcVersion = $jsonRpcVersion;
        $this->id = 1;
    }

    /**
     * @param mixed[] $params
     *
     * @throws RequestFailed
     */
    public function callMethod(string $method, array $params): stdClass
    {
        $request = [
            'jsonrpc' => $this->jsonRpcVersion,
            'method' => $method,
            'params' => array_values($params),
            'id' => $this->id,
        ];

        $body = Json::encode($request);
        $rawResponse = $this->client->post($body);

        $response = Json::decode($rawResponse);
        assert($response instanceof stdClass);

        if ($response->id !== $this->id) {
            throw new RequestFailed(
                sprintf('Given ID %d, differs from expected %d', $response->id, $this->id)
            );
        }

        return $response;
    }
}
