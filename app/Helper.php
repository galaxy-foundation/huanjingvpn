<?php
namespace App;

class Helper {
	public const TERABYTES = 1099511627776;
	public const GIGABYTES = 1073741824;
    public const MEGABYTES = 1048576;
    public const KILOBYTES = 1024;
	public const LANG = [
		'en' => 'English',
		'zh' => '中文（简体）',
	];
    public static function hash(string $plain) {
		$s=unpack("H*", hash_hmac('sha256', $plain, env('VERIFY_HASHKEY'), true));
		return	$s[1];
	}
	private static function crypto_rand_secure($min, $max) {
			$range = $max - $min;
			if ($range < 1) return $min; // not so random...
			$log = ceil(log($range, 2));
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do {
					$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
					$rnd = $rnd & $filter; // discard irrelevant bits
			} while ($rnd > $range);
			return $min + $rnd;
	}
	public static function getToken($length) {
			$token = "";
			$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
			$codeAlphabet.= "0123456789";
			$max = strlen($codeAlphabet); // edited
			for ($i=0; $i < $length; $i++) {
					$token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
			}
			return $token;
	}
	public static function getSizeText($size) {
		if($size>self::TERABYTES) return round($size/self::TERABYTES, 2)."TB";
		if($size>self::GIGABYTES) return round($size/self::GIGABYTES, 2)."GB";
        if($size>self::MEGABYTES) return round($size/self::MEGABYTES, 2)."MB";
        if($size>self::KILOBYTES) return round($size/self::KILOBYTES, 2)."KB";
        return $size."B";
    }
	public static function encrypt($plain) {
		$secret = "7zhTchRHHrHHgTxmQMx5tFpuREpVGJ4q";
		$iv=substr($secret, 0, 16);
		return openssl_encrypt($plain, "AES-256-CBC", $secret,0,$iv);
	}
	public static function decrypt($enc) {
		$secret = "7zhTchRHHrHHgTxmQMx5tFpuREpVGJ4q";
		$iv=substr($secret, 0, 16);
		return openssl_decrypt($enc, "AES-256-CBC", $secret,0,$iv);
	}
	public static function enc($plain) {
		$secret = "7zhTchRHHrHHgTxmQMx5tFpuREpVGJ4q";
		$iv=substr($secret, 0, 16);
		return openssl_encrypt($plain, "AES-256-CBC", $secret,0,$iv);
	}
	public static function dec($enc) {
		$secret = "7zhTchRHHrHHgTxmQMx5tFpuREpVGJ4q";
		$iv=substr($secret, 0, 16);
		return openssl_decrypt($enc, "AES-256-CBC", $secret,0,$iv);
	}
	public static function btc($satoshi,$ignorTrail=false) {
		$btc=$satoshi/100000000.0;
		$result=number_format($btc, 8);
		if($ignorTrail) return rtrim($result, "0");
		return $result;
	}
	public static function satoshi($btc) {
		return $btc*100000000;
	}
	public static function api($url,$headers=null) {
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 5); //timeout in seconds

		$result = curl_exec($ch); 
		curl_close($ch);
		if($result) return json_decode($result,1);
		return null;
	}
	public static function bitcoin_balance($address) {
		if($res=self::api('https://api.smartbit.com.au/v1/blockchain/address/'.$address)) {
			if($res['success'] && $addr=$res['address']) return $addr['total']['balance_int'];
			return 0;
		}
		if($result=self::api('https://api.blockcypher.com/v1/btc/main/addrs/'.$address)) {
			return $result['final_balance'];
		}
		if($result=self::api('https://insight.bitpay.com/api/addr/'.$address)) {
			return $result['balanceSat']+$result['unconfirmedBalanceSat'];
		}
		return false;
	}
	public static function bitcoin_receive($address,$uncomfirmed=TRUE) {
		if($res=self::api('https://api.smartbit.com.au/v1/blockchain/address/'.$address)) {
			if($res['success'] && $addr=$res['address']) return $addr['total']['balance_int'];
			return 0;
		}
		if($result=self::api('https://api.blockcypher.com/v1/btc/main/addrs/'.$address)) {
			return $result['final_balance'];
		}
		if($result=self::api('https://insight.bitpay.com/api/addr/'.$address)) {
			return $result['balanceSat']+$result['unconfirmedBalanceSat'];
		}
		return false;
	}
	public static function bitcoin_tx($tx) {
		if($res=self::api('https://api.smartbit.com.au/v1/blockchain/tx/'.$tx)) {
			if($res['success'] && $trans=$res['transaction']) return $trans['confirmations'];
			return 0;
		}
		if($result=self::api('https://api.blockcypher.com/v1/btc/main/txs/'.$tx)) {
			return $result['confirmations'];
		}
		if($result=self::api('https://insight.bitpay.com/api/tx/'.$tx)) {
			return $result['confirmations'];
		}
		return 0;
	}
	public static function bitcoin_pay($privKey,$leftover,$target) {
		$path=realpath(__DIR__."/../pay.py");
		$line="/usr/bin/python3.7 $path -p $privKey $leftover $target";

		if($result = shell_exec($line)) {
			echo "<p>".$result;
			$len=strlen($result);
			if($len>60 && $len<70) {
				return trim($result,"\n");
			}
		}else{
			echo "<p>".$line;
		}
		
		return null;
	}
	public static function bbcode($input){
		/* $input = htmlentities(strip_tags($input));
		$search = array(
			'/\r\n\r\n/is',
			'/\[b\](.*?)\[\/b\]/is',
			'/\[i\](.*?)\[\/i\]/is',
			'/\[u\](.*?)\[\/u\]/is',
			'/\[url=(.*?)\](.*?)\[\/url\]/is',
			'/\[urlnw=(.*?)\](.*?)\[\/urlnw\]/is',
		);
		$replace = array(
			'</p>
			
			<p>',
			'<span style="font-weight:bold">$1</span>',
			'<span style="font-style:italic">$1</span>',
			'<span style="text-decoration:underline">$1</span>',
			'<a href="$1">$2</a>',
			'<a href="$1" target="_blank">$2</a>',
		);
		$symbols = array(
			'/[\r\n]{4,}/m' => '</p><p>',
			'/[\r\n]{2,}/m' => '<br />'
			);
			
			foreach($symbols as $symb => $repl) {
			$input = preg_replace($symb, $repl, $input);
		}*/
	}
	public static function error(int $code,string $message) {
		http_response_code($code);
        echo $message;
	}
}