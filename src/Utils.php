<?php declare(strict_types = 1);

namespace Achse\GethJsonRpcPhpClient;

use Nette\Utils\Strings;
use function bcadd;
use function bcmul;
use function bcpow;
use function hexdec;
use function strlen;
use function substr;

class Utils
{
    /**
     * @see http://stackoverflow.com/questions/1273484/large-hex-values-with-php-hexdec
     */
    public static function bigHexToBigDec(string $hex): string
    {
        if (Strings::startsWith($hex, '0x')) {
            $hex = substr($hex, 2);
        }

        $dec = '0';
        $len = strlen($hex);
        for ($i = 1; $i <= $len; $i++) {
            $pow = bcpow('16', (string)($len - $i));
            $toDec = (string)hexdec($hex[$i - 1]);
            $mul = bcmul($toDec, $pow);
            $dec = bcadd($dec, $mul);
        }

        return $dec;
    }
}
