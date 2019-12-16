<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient;

require_once __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Tester\TestCase;

class UtilsTest extends TestCase
{
    /**
     * @dataProvider getDataForBigHexToBigDec
     */
    public function testBigHexToBigDec(string $expectedBigDec, string $bigHex): void
    {
        Assert::equal($expectedBigDec, Utils::bigHexToBigDec($bigHex));
    }

    /**
     * @return string[][]
     */
    public function getDataForBigHexToBigDec(): array
    {
        return [
            ['0', ''],

            ['1', '1'],
            ['15', 'F'],
            ['16', '10'],

            ['100000000000000000', '0x16345785d8a0000'],
        ];
    }
}



(new ClientTest())->run();
