<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient;

use function bcadd;
use function bcmul;
use function bcpow;
use function hexdec;
use function strlen;
use function strval;

class Utils
{
    /**
     * @see http://stackoverflow.com/questions/1273484/large-hex-values-with-php-hexdec
     */
    public static function bigHexToBigDec(string $hex): string
    {
        $dec = '0';
        $len = strlen($hex);
        for ($i = 1; $i <= $len; $i++) {
            $dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($len - $i))));
        }

        return $dec;
    }
}
