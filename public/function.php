<?php

//文字コードに関連する定数
define("ENC_TYPE", "UTF-8");

//出力に関連する定数
define("OUT_ENC_TYPE", "SJIS");

// マスタデータ
// 都道府県
function get_pref($pref_id)
{
$pref_arr = [
        "1" => "北海道",
        "2" => "青森県",
        "3" => "岩手県",
        "4" => "宮城県",
        "5" => "秋田県",
        "6" => "山形県",
        "7" => "福島県",
        "8" => "茨城県",
        "9" => "栃木県",
        "10" => "群馬県",
        "11" => "埼玉県",
        "12" => "千葉県",
        "13" => "東京都",
        "14" => "神奈川県",
        "15" => "新潟県",
        "16" => "富山県",
        "17" => "石川県",
        "18" => "福井県",
        "19" => "山梨県",
        "20" => "長野県",
        "21" => "岐阜県",
        "22" => "静岡県",
        "23" => "愛知県",
        "24" => "三重県",
        "25" => "滋賀県",
        "26" => "京都府",
        "27" => "大阪府",
        "28" => "兵庫県",
        "29" => "奈良県",
        "30" => "和歌山県",
        "31" => "鳥取県",
        "32" => "島根県",
        "33" => "岡山県",
        "34" => "広島県",
        "35" => "山口県",
        "36" => "徳島県",
        "37" => "香川県",
        "38" => "愛媛県",
        "39" => "高知県",
        "40" => "福岡県",
        "41" => "佐賀県",
        "42" => "長崎県",
        "43" => "熊本県",
        "44" => "大分県",
        "45" => "宮崎県",
        "46" => "鹿児島県",
        "47" => "沖縄県"
    ];
$pref = $pref_arr[$pref_id];

return $pref;

}

// 生年月日
function get_birth_year($birth_year) {
$year_arr = [
        "1940" => "1940(昭和15)",
        "1941" => "1941(昭和16)",
        "1942" => "1942(昭和17)",
        "1943" => "1943(昭和18)",
        "1944" => "1944(昭和19)",
        "1945" => "1945(昭和20)",
        "1946" => "1946(昭和21)",
        "1947" => "1947(昭和22)",
        "1948" => "1948(昭和23)",
        "1949" => "1949(昭和24)",
        "1950" => "1950(昭和25)",
        "1951" => "1951(昭和26)",
        "1952" => "1952(昭和27)",
        "1953" => "1953(昭和28)",
        "1954" => "1954(昭和29)",
        "1955" => "1955(昭和30)",
        "1956" => "1956(昭和31)",
        "1957" => "1957(昭和32)",
        "1958" => "1958(昭和33)",
        "1959" => "1959(昭和34)",
        "1960" => "1960(昭和35)",
        "1961" => "1961(昭和36)",
        "1962" => "1962(昭和37)",
        "1963" => "1963(昭和38)",
        "1964" => "1964(昭和39)",
        "1965" => "1965(昭和40)",
        "1966" => "1966(昭和41)",
        "1967" => "1967(昭和42)",
        "1968" => "1968(昭和43)",
        "1969" => "1969(昭和44)",
        "1970" => "1970(昭和45)",
        "1971" => "1971(昭和46)",
        "1972" => "1972(昭和47)",
        "1973" => "1973(昭和48)",
        "1974" => "1974(昭和49)",
        "1975" => "1975(昭和50)",
        "1976" => "1976(昭和51)",
        "1977" => "1977(昭和52)",
        "1978" => "1978(昭和53)",
        "1979" => "1979(昭和54)",
        "1980" => "1980(昭和55)",
        "1981" => "1981(昭和56)",
        "1982" => "1982(昭和57)",
        "1983" => "1983(昭和58)",
        "1984" => "1984(昭和59)",
        "1985" => "1985(昭和60)",
        "1986" => "1986(昭和61)",
        "1987" => "1987(昭和62)",
        "1988" => "1988(昭和63)",
        "1989" => "1989(昭和64/平成1)",
        "1990" => "1990(平成2)",
        "1991" => "1991(平成3)",
        "1992" => "1992(平成4)",
        "1993" => "1993(平成5)",
        "1994" => "1994(平成6)",
        "1995" => "1995(平成7)",
        "1996" => "1996(平成8)",
        "1997" => "1997(平成9)",
        "1998" => "1998(平成10)",
        "1999" => "1999(平成11)",
        "2000" => "2000(平成12)",
        "2001" => "2001(平成13)",
        "2002" => "2002(平成14)",
        "2003" => "2003(平成15)",
        "2004" => "2004(平成16)",
        "2005" => "2005(平成17)",
        "2006" => "2006(平成18)",
        "2007" => "2007(平成19)",
        "2008" => "2008(平成20)"
    ];
$year = $year_arr[$birth_year];

return $year;
}

// 職業
function get_job($job_id) {
$job_arr = [
        "1" => "会社員",
        "2" => "公務員",
        "3" => "自営業",
        "4" => "契約社員",
        "5" => "専業主婦",
        "6" => "パート主婦",
        "7" => "フリーター",
        "8" => "水商売",
        "9" => "生活保護者",
        "10" => "年金受給者"
    ];
$job = $job_arr[$job_id];

return $job;
}

// 借入希望金額
function get_desired_borrowing($desired_borrowing_id) {
$desired_borrowing_arr = [
        "1" => "1万円",
        "2" => "3万円",
        "3" => "5万円",
        "4" => "10万円",
        "5" => "20万円",
        "6" => "20万円以上"
    ];
$desired_borrowing = $desired_borrowing_arr[$desired_borrowing_id];

return $desired_borrowing;
}

// 希望連絡時間帯
function get_time($time_id) {
$time_arr = [
        "1" => "9:00～12:00に連絡希望",
        "2" => "12:00～15:00に連絡希望",
        "3" => "15:00～18:00に連絡希望",
        "4" => "18:00以降に連絡希望",
        "5" => "特になし"
    ];
$time = $time_arr[$time_id];

return $time;
}


function ad($ary = "")
{
    echo "<pre>";
    print_r($ary);
    echo "</pre>";
}

// クロスサイドスクリプション対策のため文字列のエスケープ処理を行う関数
function esc_html($str, $escape = ENT_QUOTES, $encode = ENC_TYPE)
{
    return htmlspecialchars($str, $escape, $encode);
}

// HTMLのタブ内で文字列を出力する場合に記述を少なくするため
// 変数に文字列が代入されていた場合文字列のエスケープ処理を行う関数
function output_data(&$str = "")
{
    if (cempty($str)) {
        return $str;
    }
    return esc_html($str);
}

// メール送信機能
function sendMail($to, $subject, $message, $from, $cc, $bcc, $files) {
	// デバッグフラグ設定
	$debug = true;
	$debug = false;

	// MIMEタイプ定義配列（※添付ファイルの対応種別が増えるたびに追加）
	$mime_content_types = array();
	$mime_content_types['txt'] = 'text/plane';
	$mime_content_types['zip'] = 'application/x-zip-compressed';
	$mime_content_types['gz'] = 'application/x-tar';
	$mime_content_types['tar'] = 'application/x-tar';

	// 件名・本文をエンコード
//	$subject = mb_convert_encoding($subject, 'JIS', 'UTF-8');
	$message = mb_convert_encoding($message, 'JIS', 'UTF-8');

	// 件名付加文字列処理
//	$subject = '=?iso-2022-jp?B?'.base64_encode($subject).'?=';

	// 添付ファイル有無判定
	if(empty($files)) {
		// バウンダリ文字列（空）設定
		$boundary = null;
	} else {
		// バウンダリ文字列（乱数）設定
		$boundary = md5(uniqid(rand(), true));
	}

	// 添付ファイル有無判定
	if(empty($files)) {
		// 添付ファイル無しの場合内容をそのまま組み込み
		$body = $message;
	} else {
		// 添付ファイルごとの組み込み
		$body  = "--$boundary\n";
		$body .= "Content-Type: text/plain; charset=\"iso-2022-jp\"\n";
		$body .= "Content-Transfer-Encoding: 7bit\n";
		$body .= "\n";
		$body .= "$message\n";
		// 添付ファイル数分繰り返し
		foreach($files as $file) {
			// 添付ファイルの存在判定
			if(!file_exists($file)) {
				// 添付ファイルが存在しない場合は次へ
				continue;
			}
			// 添付ファイル情報（dirname/basename/extension/filename）を設定
			// ※/sample/sample.txt→（'/sample','sample.txt','txt','sample'）
			$info = pathinfo($file);
			// 拡張子情報（extension）を取得しMIMEタイプを設定
			$content = $mime_content_types[$info['extension']];
			// ベース名（basename）を設定
			$filename = $info['basename'];
			// その他メールボディ設定
			$body .= "\n";
			$body .= "--$boundary\n";
			$body .= "Content-Type: $content; name=\"$filename\"\n";
			$body .= "Content-Disposition: attachment; filename=\"$filename\"\n";
			$body .= "Content-Transfer-Encoding: base64\n";
			$body .= "\n";
			// 添付ファイル内容読み込みBASE64エンコード後メールボディに追加
			$body .= chunk_split(base64_encode(file_get_contents($file)))."\n";
		}
		// バウンダリ（メール文章部/添付ファイル部区切り）文字列追加
		$body .= '--'.$boundary.'--';
	}

	// メールヘッダ
	$header = "From: $from\n";
	$header .= "Reply-To: $from\n";	
	$header .= "MIME-Version: 1.0\n";
	// 添付ファイル有無判定
	if(empty($files)) {
		// 添付ファイル無しの場合のコンテンツ種別設定
		$header .= "Content-Type: text/plain; charset=\"iso-2022-jp\"\n";
	} else {
		// 添付ファイル有りの場合のコンテンツ種別設定
		$header .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
	}
	// 共通ヘッダの設定（デフォルトと同一）
	$header .= "Content-Transfer-Encoding: 7bit";

	// デバッグ表示
	if($debug) {
		print("<br>\n");
		printf("to:[%s]<br>\n", $to);
		printf("subject:[%s]<br>\n", $subject);
		printf("body:[%s]<br>\n", $body);
		printf("header:[%s]<br>\n", $header);
	}

	//メール送信
	if(mb_send_mail($to, $subject, $body, $header, '-f' . $from)) {
		// デバッグ表示
		if($debug) {
			print('メール送信OK');
		}
		// メール送信結果設定（OK：true）
		$result = true;
	} else {
		// デバッグ表示
		if($debug) {
			print('メール送信NG');
		}
		// メール送信結果設定（NG：false）
		$result = false;
	}
	// 結果返却
	return $result;
}
