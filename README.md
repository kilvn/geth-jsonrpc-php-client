[![Downloads this Month](https://img.shields.io/packagist/dm/letsagree/geth-jsonrpc-php-client.svg)](https://packagist.org/packages/letsagree/geth-jsonrpc-php-client)
[![Latest Stable Version](https://poser.pugx.org/letsagree/geth-jsonrpc-php-client/v/stable)](https://github.com/letsagree/geth-jsonrpc-php-client/releases)
![](https://travis-ci.org/letsagree/geth-jsonrpc-php-client.svg?branch=master)
![](https://scrutinizer-ci.com/g/letsagree/geth-jsonrpc-php-client/badges/quality-score.png?b=master)
![](https://scrutinizer-ci.com/g/letsagree/geth-jsonrpc-php-client/badges/coverage.png?b=master)

# Introduction
This API client lib is used to communicate with `geth` (go-ethereum) node.

Via this client lib you can easily run operation on the node such is:
* Get account balance,
* sign transactions,
* deploy transactions,
* ...

Full documentation of all methods that can be run on `geth` node are
described here: https://github.com/ethereum/wiki/wiki/JSON-RPC#json-rpc-methods


# Install
```
composer require letsagree/geth-jsonrpc-php-client
```

# Usage
```php
// Create HTTP client instance (you can use something simplier just wrap it by using IHttpClient interface)
$httpClient = new GuzzleClient('localhost', 8545);

// Create JsonRpc client which can run any operation on your geth node
$client = new Client($httpClient);

// Run operation (all are described here: https://github.com/ethereum/wiki/wiki/JSON-RPC#json-rpc-methods)
$result = $client->callMethod('eth_getBalance', ['0xf99ce9c17d0b4f5dfcf663b16c95b96fd47fc8ba', 'latest']);

// $result ==='0x16345785d8a0000'
```
