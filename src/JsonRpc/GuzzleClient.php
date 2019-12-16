<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient\JsonRpc;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use function assert;
use function sprintf;

final class GuzzleClient implements IHttpClient
{
    private ?GuzzleHttpClient $client = null;

    /** @var string[] */
    private array $options;

    private GuzzleClientFactory $guzzleClientFactory;

    public function __construct(GuzzleClientFactory $guzzleClientFactory, string $url, ?int $port = null)
    {
        $this->guzzleClientFactory = $guzzleClientFactory;

        $this->options = [
            'base_uri' => $port !== null ? sprintf('%s:%d', $url, $port) : $url,
        ];
    }

    public function post(string $body): string
    {
        try {
            $this->openClient();
            assert($this->client !== null);
            $response = $this->client->post('', ['body' => $body, 'headers' => ['Content-Type' => 'application/json']]);
        } catch (RequestException $exception) {
            throw new RequestFailed(
                sprintf('Request failed due to Guzzle exception: "%s".', $exception->getMessage()),
                $exception->getCode(),
                $exception
            );
        }

        return $response->getBody()->getContents();
    }

    private function openClient(): void
    {
        if ($this->client !== null) {
            return;
        }

        $this->client = $this->guzzleClientFactory->create($this->options);
    }
}
