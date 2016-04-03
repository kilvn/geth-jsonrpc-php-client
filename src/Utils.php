<?php

namespace LetsAgree\GethJsonRpcPhpClient;

use Nette\Object;



class Utils extends Object
{

	/**
	 * @see http://stackoverflow.com/questions/1273484/large-hex-values-with-php-hexdec
	 *
	 * @param string $hex
	 * @return string
	 */
	public static function bigHexToBigDec($hex)
	{
		$dec = '0';
		$len = strlen($hex);
		for ($i = 1; $i <= $len; $i++) {
			$dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($len - $i))));
		}

		return $dec;
	}

}
