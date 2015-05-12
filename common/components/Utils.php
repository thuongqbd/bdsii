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
			'D' => 'Đ',
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
}

