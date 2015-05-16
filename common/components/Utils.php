<?php
namespace common\components;

use Yii;

class Utils {
	
	public static function stripUnicode($str,$justStripDiacritic = false) {
		if (!$str) {
			return false;
		}
		$unicode = array(
			'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
			'd' => 'đ',
			'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			'i' => 'í|ì|ỉ|ĩ|ị',
			'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
		);
		if($justStripDiacritic)
			$ui = "";
		else 
			$ui = "ui";
	
		foreach ($unicode as $nonUnicode => $uni) {
			$str = preg_replace("/($uni)/$ui", $nonUnicode, $str);
		}
		if($justStripDiacritic){
			return $str;
		}
		$str = strtolower(str_replace(
						array('　',';', ' - ', '.', ',', ':', '"', "'", '_', ' ', '/', '&', '“', '”', '!', '^', ')', '(', '|', '?', ' @ ', ' @', '@ ', '’'), array('', '-', '', '-', '', '', '', '-', '-', '-', '-', '', '', '', '', '', '', '', '', '', '', '', ''), trim($str)));
		return $str;
	}

	public static function getSeoUrl($sTitle) {
		$sTitle = rawurldecode(self::stripUnicode($sTitle));
		return $sTitle;
	}
	
	public static function sub_string($str, $len = 50, $more = '...') {
		if ($str == "" || $str == NULL || is_array($str) || mb_strlen($str) < $len) {
			return $str;
		}
		$is_more = false;
		$lastspace = (strrpos($str, " ", 0));
		$counword = str_word_count($str);
		if ($lastspace === false && $counword <= $len)
			$retval = $str;
		else {
			$words = explode(" ", $str);
			$retval = implode(" ", array_splice($words, 0, $len));
			$is_more = true;
		}

//		$retval = preg_replace("/[[:blank:]]+/", " ", $retval);
		$retval .= ($is_more == true) ? $more : "";
		return $retval;
	}
	
	public static function checkExistImage($path,$base_url) {
		
		$a = explode(Yii::getAlias('@storageUrl'), $base_url);
		$uploadDir = $a[1];
		$imageFullPath = implode( array(Yii::getAlias('@storage'),'/web', $uploadDir,'/', $path));	
//		var_dump($imageFullPath,urldecode($imageFullPath),file_exists(urldecode($imageFullPath)));die;
		if (file_exists(urldecode($imageFullPath))) {
			return true;
		}
		return false;
	}
	
	
}

