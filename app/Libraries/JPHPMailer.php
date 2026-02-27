<?php 
namespace App\Libraries;
require_once app_path('Libraries/phpmailer.php');

class JPHPMailer extends PHPMailer {
	var $CharSet = "iso-2022-jp";
	var $Encoding = "7bit";
	var $in_enc = "UTF-8"; //ÆâÉô¥¨¥ó¥³¡¼¥É
	
	/**
	 * °¸Àè¤òÄÉ²Ã
	 * 
	 * $name <$address> ¤È¤¤¤¦½ñ¼°¤Ë¤Ê¤ë¡£
	 * 
	 * @param string $address ¥á¡¼¥ë¥¢¥É¥ì¥¹
	 * @param string $name Ì¾Á°
	 */
	function addAddress($address,$name="") {
		if ($name){
			$name = $this->encodeMimeHeader(mb_convert_encoding($name,"JIS",$this->in_enc));
		}
		parent::addAddress($address,$name);
	}

	/**
	 * °¸Àè¤òÄÉ²Ã (addAddress¤Î¥¨¥¤¥ê¥¢¥¹)
	 * 
	 * $name <$address> ¤È¤¤¤¦½ñ¼°¤Ë¤Ê¤ë¡£
	 * 
	 * @param string $address ¥á¡¼¥ë¥¢¥É¥ì¥¹
	 * @param string $name Ì¾Á°
	 */
	function addTo($address,$name="") {
		$this->addAddress($address,$name);
	}

	/**
	 * CC¤òÄÉ²Ã
	 * 
	 * $name <$address> ¤È¤¤¤¦½ñ¼°¤Ë¤Ê¤ë¡£
	 * 
	 * @param string $address ¥á¡¼¥ë¥¢¥É¥ì¥¹
	 * @param string $name Ì¾Á°
	 */
	function addCc($address,$name="") {
		if ($name){
			$name = $this->encodeMimeHeader(mb_convert_encoding($name,"JIS",$this->in_enc));
		}
		parent::addCc($address,$name);
	}

	/**
	 * BCC¤òÄÉ²Ã
	 * 
	 * $name <$address> ¤È¤¤¤¦½ñ¼°¤Ë¤Ê¤ë¡£
	 * 
	 * @param string $address ¥á¡¼¥ë¥¢¥É¥ì¥¹
	 * @param string $name Ì¾Á°
	 */
	function addBcc($address,$name="") {
		if ($name){
			$name = $this->encodeMimeHeader(mb_convert_encoding($name,"JIS",$this->in_enc));
		}
		parent::addBcc($address,$name);
	}

	/**
	 * Reply-To¤òÄÉ²Ã
	 * 
	 * $name <$address> ¤È¤¤¤¦½ñ¼°¤Ë¤Ê¤ë¡£
	 * 
	 * @param string $address ¥á¡¼¥ë¥¢¥É¥ì¥¹
	 * @param string $name Ì¾Á°
	 */
	function addReplyTo($address,$name="") {
		if ($name){
			$name = $this->encodeMimeHeader(mb_convert_encoding($name,"JIS",$this->in_enc));
		}
		parent::addReplyTo($address,$name);
	}
	
	/**
	 * ÂêÌ¾¤ò¥»¥Ã¥È¤¹¤ë
	 * 
	 * @param string $subject ÂêÌ¾
	 */
	function setSubject($subject){
		$this->Subject = $this->encodeMimeHeader(mb_convert_encoding($subject,"JIS",$this->in_enc));
	}
	
	/**
	 * º¹½Ð¿Í¥¢¥É¥ì¥¹¤ò¥»¥Ã¥È¤¹¤ë
	 * 
	 * @param string $from º¹½Ð¿Í¤Î¥á¡¼¥ë¥¢¥É¥ì¥¹
	 * @param string $fromname º¹¤·½Ð¤·¿ÍÌ¾
	*/
	function setFrom($from,$fromname=""){
		$this->From = $from;
		//$this->Hostname = "smtp.xxxxx.com";
		$this->Sender = $from;
		if ($fromname){
			$this->setFromName($fromname);
		}
	}
	
	/**
	 * º¹¤·½Ð¤·¿ÍÌ¾¤ò¥»¥Ã¥È¤¹¤ë
	 * @param string $fromname º¹¤·½Ð¤·¿ÍÌ¾
	 */
	function setFromName($fromname){
		$this->FromName = $this->encodeMimeHeader(mb_convert_encoding($fromname,"JIS",$this->in_enc));
	}

	/**
	 * ËÜÊ¸¤ò¥»¥Ã¥È¤¹¤ë¡£(text/plain)
	 * 
	 * @param string $body ËÜÊ¸
	 */
	function setBody($body){
		$this->Body = mb_convert_encoding($body,"JIS",$this->in_enc);
		$this->AltBody = "";
		$this->IsHtml(false);
	}

	/**
	 * ËÜÊ¸¤ò¥»¥Ã¥È¤¹¤ë¡£(text/html)
	 * 
	 * @param string $htmlbody ËÜÊ¸ (HTML)
	 */
	function setHtmlBody($htmlbody){
		$this->Body = mb_convert_encoding($htmlbody,"JIS",$this->in_enc);
		$this->IsHtml(true);
	}
	
	/**
	 * ÂåÂØ¤¨ËÜÊ¸¤ò¥»¥Ã¥È¤¹¤ë¡£(text/plain)
	 * setHtmlBody()¤ò»È¤Ã¤¿»þ¡¢HTML¤òÆÉ¤á¤Ê¤¤¥á¡¼¥ë¥¯¥é¥¤¥¢¥ó¥ÈÍÑ¤ÎÊ¿Ê¸¤ò¥»¥Ã¥È¤Ç¤­¤ë¡£
	 * 
	 * @param string $altbody ËÜÊ¸
	 */
	function setAltBody($altbody){
		$this->AltBody = mb_convert_encoding($altbody,"JIS",$this->in_enc);
	}
	
	/**
	 * ¥«¥¹¥¿¥à¥Ø¥Ã¥À¡¼¤òÄÉ²Ã
	 * 
	 * @param string $key ¥Ø¥Ã¥À¡¼¥­¡¼
	 * @param string $value ¥Ø¥Ã¥À¡¼ÃÍ
	 */
	function addHeader($key,$value){
		if (!$value){
			return;
		}
		$this->addCustomHeader($key.":".$this->encodeMimeHeader(mb_convert_encoding($value,"JIS",$this->in_enc)));
	}
	
	/**
	 * ¥¨¥é¡¼¥á¥Ã¥»¡¼¥¸¤ò¼èÆÀ¤¹¤ë
	 * 
	 * @return string ¥¨¥é¡¼¥á¥Ã¥»¡¼¥¸
	 */
	function getErrorMessage(){
		return $this->ErrorInfo;
	}
	
	/**
	 * PHPMailer¤ÎencodeHeader¤ò¥ª¡¼¥Ð¡¼¥é¥¤¥É¤·¤ÆÌµ¸ú²½
	 */
	function encodeHeader($str, $position='text'){
		return $str;
	}
	
	/**
	 * Mime¥¨¥ó¥³¡¼¥É½èÍý
	 * 
	 * php¤Îmb_encode_mimeheader¤Ç¤Ï¡¢Ä¹¤¤Ê¸»úÎó¤Ç²þ¹Ô¤µ¤ì¤º¥á¡¼¥ë¥Ø¥Ã¥À¤Îµ¬Â§¤Ë¤¢¤ï¤Ê¤¤¡£
	 */
	function encodeMimeHeader($string,$charset=null,$linefeed="\r\n"){
		if (!strlen($string)){
			return "";
		}
		
		if (!$charset)
			$charset = $this->CharSet;
	
		$start = "=?$charset?B?";
		$end = "?=";
		$encoded = '';
	
		/* Each line must have length <= 75, including $start and $end */
		$length = 75 - strlen($start) - strlen($end);
		/* Average multi-byte ratio */
		$ratio = mb_strlen($string, $charset) / strlen($string);
		/* Base64 has a 4:3 ratio */
		$magic = $avglength = floor(3 * $length * $ratio / 4);
	
		for ($i=0; $i <= mb_strlen($string, $charset); $i+=$magic) {
			$magic = $avglength;
			$offset = 0;
			/* Recalculate magic for each line to be 100% sure */
			do {
				$magic -= $offset;
				$chunk = mb_substr($string, $i, $magic, $charset);
				$chunk = base64_encode($chunk);
				$offset++;
			} while (strlen($chunk) > $length);
			
			if ($chunk)
				$encoded .= ' '.$start.$chunk.$end.$linefeed;
		}
		/* Chomp the first space and the last linefeed */
		$encoded = substr($encoded, 1, -strlen($linefeed));
	
		return $encoded;
	}
}