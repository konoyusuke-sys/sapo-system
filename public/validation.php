<?php

function validation ($key ,$value) {
    $msg = "";

    switch ($key) {
        case "name_sei" :
            if (cempty($value)) {
                $msg = "姓を入力してください。";
            } elseif (mb_strlen($value) > 50) {
                $msg = "姓は50文字以内で入力してください。";
            }
            break;
        case "name_mei" :
            if (cempty($value)) {
                $msg = "名を入力してください。";
            } elseif (mb_strlen($value) > 50) {
                $msg = "名は50文字以内で入力してください。";
            }
            break;
        case "name_kana" :
            if (cempty($value)) {
                $msg = "お名前(ふりがな)を入力してください。";
            } elseif (mb_strlen($value) > 50) {
                $msg = "お名前(ふりがな)は50文字以内で入力してください。";
            }
            break;
        case "name_kana" :
            if (cempty($value)) {
                $msg = "お名前(ふりがな)を入力してください。";
            } elseif (mb_strlen($value) > 50) {
                $msg = "お名前(ふりがな)は50文字以内で入力してください。";
            }
            break;
        case "your_mail" :
            if (cempty($value)) {
                $msg = "メールアドレスを入力してください。";
            } elseif (mb_strlen($value) > 100) {
                $msg = "メールアドレスは100文字以内で入力してください。";
            } elseif (!chk_mail($value)) {
                $msg = "メールアドレスを正しく入力してください。";
            }
            break;
        case "your_line" :
            if (!cempty($value)) {
                if (mb_strlen($value) > 50) {
                    $msg = "LINE IDは50文字以内で入力してください。";
                } elseif (!preg_match("/^[a-zA-Z0-9]*/", $value)) {
                    $msg = "LINE IDを正しく入力してください。";
                }
            }
            break;
        case "birth_year" :
            if (cempty($value)) {
                $msg = "生年月日(年)を選択してください。";
            }
            break;
        case "birth_month" :
            if (cempty($value)) {
                $msg = "生年月日(月)を選択してください。";
            }
            break;
        case "birth_date" :
            if (cempty($value)) {
                $msg = "生年月日(日)を選択してください。";
            }
            break;
        case "your_postnum" :
            if (cempty($value)) {
                $msg = "郵便番号を入力してください。";
            } elseif (!chk_zip($value)) {
                $msg = "郵便番号を正しく入力してください。";
            }
            break;
        case "pref_id" :
            if (cempty($value)) {
                $msg = "都道府県を入力してください。";
            }
            break;
        case "addr1" :
            if (cempty($value)) {
                $msg = "市区町村を入力してください。";
            } elseif (mb_strlen($value) > 100) {
                $msg = "市区町村は100文字以内で入力してください。";
            }
            break;
        case "addr2" :
            if (cempty($value)) {
                $msg = "番地などを入力してください。";
            } elseif (mb_strlen($value) > 100) {
                $msg = "番地などは100文字以内で入力してください。";
            }
            break;
        case "your_mobile" :
            if (cempty($value)) {
                $msg = "携帯電話番号を入力してください。";
            } elseif (!chk_tel($value)) {
                $msg = "携帯電話番号を正しく入力してください。";
            }
            break;
        case "job" :
            if (cempty($value)) {
                $msg = "職業を入力してください。";
            }
            break;
        case "your_company" :
            if (cempty($value)) {
                $msg = "勤務先名を入力してください。";
            } elseif (mb_strlen($value) > 100) {
                $msg = "勤務先名は100文字以内で入力してください。";
            }
            break;
        case "your_company_tel" :
            if (cempty($value)) {
                $msg = "勤務先電話番号を入力してください。";
            } elseif (!chk_tel($value)) {
                $msg = "勤務先電話番号を正しく入力してください。";
            }
            break;
        case "income" :
            if (cempty($value)) {
                $msg = "月収を入力してください。";
            }
            break;
        case "desired_borrowing" :
            if (cempty($value)) {
                $msg = "借入希望金額を入力してください。";
            }
            break;
        case "your_borrowing_num" :
            if (cempty($value)) {
                $msg = "他者借入件数を入力してください。";
            } elseif (mb_strlen($value) > 50) {
                $msg = "他者借入件数は50文字以内で入力してください。";
            }
            break;
        case "your_borrowing_num2" :
            if (cempty($value)) {
                $msg = "他者借入金額を入力してください。";
            } elseif (mb_strlen($value) > 50) {
                $msg = "他者借入金額は50文字以内で入力してください。";
            }
            break;
        case "time" :
            if (cempty($value)) {
                $msg = "希望連絡時間帯を入力してください。";
            }
            break;
        case "agree" :
            if ($value != 1) {
                $msg = "同意するにチェックしてください。";
            }
            break;
    }

    return $msg;
}

function chk_kana($input, $space = false)
{
    if (cempty($input)) return true;
    if (mb_internal_encoding() == "UTF-8") {
        if ($space) {
            if(!preg_match('/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc))*$/', str_replace(array("　", " "), "", $input))) return false;
        } else {
            if(!preg_match('/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc))*$/', $input)) return false;
        }
    } else {
        if ($space) {
            if(mb_ereg("[^ァ-ヶー]", str_replace(array("　", " "), "", $input))) return false;
        } else {
            if(mb_ereg("[^ァ-ヶー]", $input)) return false;
        }
    }
    return true;
}

function chk_hirakana($input, $space = false)
{
    if (cempty($input)) return true;
    if ($space) {
        if(mb_ereg("[^ぁ-んー]", str_replace(array("　", " "), "", $input))) return false;
    } else {
        if(mb_ereg("[^ぁ-んー]", $input)) return false;
    }
    return true;
}

function cempty($val)
{
    if (!isset($val)) return true;
    if ($val === null) return true;
    if (is_array($val)) {
        return cempty_array($val);
    }
    if (!mb_strlen($val)) return true;
    return false;
}
function chk_mail($input)
{
    if (cempty($input)) return true;
    $user   = '[a-zA-Z0-9_\-\.\+\^!#\$%&*+\/\=\?\`\|\{\}~\']+';
    //$domain = '(?:(?:[a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.?)+';
    $domain = '(?:(?:[a-zA-Z0-9]|[a-zA-Z0-9_\-][a-zA-Z0-9_\-]*[a-zA-Z0-9_\-])\.?)+';
    if(!preg_match("/^$user@$domain$/", $input) || !preg_match("/^.*@.*\..*$/", $input) || !preg_match('/^'.$user.'@[\w\-]+([\.][\w\-]+)+$/', $input)) return false;
    return true;
}

function chk_zip($input)
{
    // $input:xxx-xxxx
    if (cempty($input)) return true;
    if (cempty(str_replace("-", "", $input))) return true;
    $input = str_replace("-", "", $input);
    if(!preg_match('/^[0-9]{7}$/', $input)) return false;
    return true;
}


function chk_tel($input)
{
    // $input:xxx-xxxx-xxxx
    if (cempty($input)) return true;
    if (substr_count($input, "-") > 2) return false;
    if (cempty(str_replace("-", "", $input))) return true;

    $tel = str_replace("-", "", $input);
    $len = strlen($tel);

    if(!preg_match('/^[0-9]*$/', $tel)) return false;
    if($len > 15) return false;

    if(preg_match('/^0[5789]0/', $tel) && $len != 11) return false;
    if(!preg_match('/^0[5789]0/', $tel) && $len != 10) return false;
    return true;
}

