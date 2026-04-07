@php
  $f = $restore ?? [];
  $ov = function ($key, $default = '') use ($f) {
      return old($key, $f[$key] ?? $default);
  };
@endphp
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>カリマッチ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('js/form.js') }}"></script>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TS8QB62V');</script>
</head>

<body class="sp_form">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TS8QB62V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <div class="sp_form_container sp_container">

    <header class="flex">
      <div class="headertitlecrm widthhalf">
        <a href="{{ url('/') }}"><img src="{{ asset('image/header_title.png') }}" class="header_title" alt="カリマッチ"></a>
      </div>
      <div class="headerctacrm widthhalf">
        <a href="{{ route('form_index') }}"><img src="{{ asset('image/header_cta.png') }}" class="header_cta" alt="お申込み"></a>
      </div>
    </header>

    <div class="form_sec01">
      <div>
        <p class="f_sectitle">お申込フォーム</p>
      </div>
    </div>

    <section id="application" class="application_sec">
      <div class="">
        @if ($errors->any())
          <div class="f_text" style="color:red;margin:1em 0;">
            @foreach ($errors->all() as $message)
              <p>{{ $message }}</p>
            @endforeach
          </div>
        @endif

        <form name="lifeform" method="post" action="{{ route('display') }}" enctype="multipart/form-data" class="area_form h-adr" id="docform" novalidate>
          @csrf

            <dl class="req">
              <dt class="f_title">お名前<span class="f_required">必須</span></dt>
              <dd class="col2">
                <span class="f_text">姓
                  <input class="chk w50 validate[required]" type="text" id="your_name_sei" name="name_sei" value="{{ $ov('name_sei') }}" placeholder="例）○○" />
                </span>
                <br>
                <span class="f_text">名
                  <input class="chk w50 validate[required]" type="text" id="your_name_mei" name="name_mei" value="{{ $ov('name_mei') }}" placeholder="例）●●" />
                </span>
              </dd>
            </dl>

              <dl class="req">
                  <dt class="f_title">お名前（ふりがな）<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="your_name_kana" name="name_kana" value="{{ $ov('name_kana') }}" placeholder="例）○○ ●●" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">メールアドレス<span class="f_required">必須</span></dt>
                  <dd>
                      <input type="email" class="chk validate[required,custom[email]] m_b5" id="your_mail" name="your_mail" value="{{ $ov('your_mail') }}" placeholder="例）○○○○@▲▲▲▲▲.jp " />
                  </dd>
              </dl>

              <dl class="any">
                  <dt class="f_title">LINE ID<span class="f_free">任意</span></dt>
                  <dd>
                      <input type="text" id="your_line" name="your_line" value="{{ $ov('your_line') }}" placeholder="例）abcd1234" />
                      <p class="caption f_text">
                          半角英数字で入力してください<br />
                          <em>※LINE登録ですとスムーズにやりとりが可能になります。</em>
                      </p>
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">生年月日<span class="f_required">必須</span></dt>
                  <dd class="">
                      <div class="row col3 w500">
                          <span class="birthday">
                              <select name="birth_year" id="birth" class="chk validate[required]">
                                  <option value="">----</option>
                                  @foreach (config('lead_form.birth_year_label') as $val => $label)
                                  <option value="{{ $val }}" {{ (string) $ov('birth_year') === (string) $val ? 'selected' : '' }}>{{ $label }}</option>
                                  @endforeach
                              </select>年
                          </span>

                          <span class="birthday">
                              <select name="birth_month" class="chk validate[required]">
                                  <option value="">----</option>
                                  @for ($m = 1; $m <= 12; $m++)
                                  <option value="{{ $m }}" {{ (string) $ov('birth_month') === (string) $m ? 'selected' : '' }}>{{ $m }}</option>
                                  @endfor
                              </select>
                              月
                          </span>

                          <span class="birthday">
                              <select name="birth_date" class="chk validate[required]">
                                  <option value="">----</option>
                                  @for ($d = 1; $d <= 31; $d++)
                                  <option value="{{ $d }}" {{ (string) $ov('birth_date') === (string) $d ? 'selected' : '' }}>{{ $d }}</option>
                                  @endfor
                              </select>
                              日
                          </span>
                      </div>
                  </dd>
              </dl>
              <span class="p-country-name" style="display: none">Japan</span>
              <dl class="req">
                  <dt class="f_title">郵便番号<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="p-postal-code validate[required] chk" type="text" id="your_postnum" name="your_postnum" value="{{ $ov('your_postnum') }}" />
                  </dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">都道府県<span class="f_required">必須</span></dt>
                  <dd>
                    <select name="pref_id" id="pref_id" class="chk validate[required]">
                        <option value="">選択してください</option>
                        @foreach (config('custom.prefecture') as $pid => $pname)
                        <option value="{{ $pid }}" {{ (string) $ov('pref_id') === (string) $pid ? 'selected' : '' }}>{{ $pname }}</option>
                        @endforeach
                    </select>
                  </dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">市区町村<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="addr1" name="addr1" value="{{ $ov('addr1') }}" placeholder="例）○○市" />
                  </dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">番地等<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="addr2" name="addr2" value="{{ $ov('addr2') }}" placeholder="例）0丁目" />
                  </dd>
              </dl>
              <dl class="any">
                  <dt class="f_title">建物名・部屋番号<span class="f_free">任意</span></dt>
                  <dd>
                      <input type="text" id="addr3" name="addr3" value="{{ $ov('addr3') }}" placeholder="0-00" />
                      <p class="caption">
                          <em class="f_text">※建物名がない方はなしと記入してください</em>
                      </p>
                  </dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">携帯電話番号<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_mobile" name="your_mobile" value="{{ $ov('your_mobile') }}" placeholder="例）08012341234" />
                      <p class="caption f_text">
                          半角英数字で入力してください<br /><em>※通電確認が取れないと融資が行えませんのでご注意ください。</em>
                      </p>
                  </dd>
              </dl>
              <dl class="any">
                  <dt class="f_title">固定電話番号<span class="f_free">任意</span></dt>
                  <dd>
                      <input type="text" id="your_tel" name="your_tel" value="{{ $ov('your_tel') }}" placeholder="例）0312345678" />
                      <p class="caption f_text">半角英数字で入力してください</p>
                  </dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">職業<span class="f_required">必須</span></dt>
                  <dd>
                      <select name="job" id="job" class="chk validate[required]">
                          <option value="">選択してください</option>
                          @foreach (config('custom.job') as $jid => $jname)
                          <option value="{{ $jid }}" {{ (string) $ov('job') === (string) $jid ? 'selected' : '' }}>{{ $jname }}</option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">勤務先名<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="your_company" name="your_company" value="{{ $ov('your_company') }}" placeholder="例）○○株式会社▲▲営業所" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">勤務先電話番号<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_company_tel" name="your_company_tel" value="{{ $ov('your_company_tel') }}" placeholder="例）0312345678" />
                      <p class="caption">半角英数字で入力してください</p>
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">月収<span class="f_required">必須</span></dt>
                  <dd>
                      <select name="income" id="income" class="chk validate[required]">
                          <option value="">選択してください</option>
                          @php
                            $incomes = ['10万円以下', '11～20万円', '21～30万円', '31～40万円', '41万円以上'];
                          @endphp
                          @foreach ($incomes as $inc)
                          <option value="{{ $inc }}" {{ $ov('income') === $inc ? 'selected' : '' }}>{{ $inc }}</option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">借入希望金額<span class="f_required">必須</span></dt>
                  <dd>
                      <select name="desired_borrowing" id="desired_borrowing" class="chk validate[required]">
                          <option value="">選択してください</option>
                          @foreach (config('custom.expectation') as $eid => $elabel)
                          <option value="{{ $eid }}" {{ (string) $ov('desired_borrowing') === (string) $eid ? 'selected' : '' }}>{{ $elabel }}</option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">他者借入件数<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_borrowing_num" name="your_borrowing_num" value="{{ $ov('your_borrowing_num') }}" placeholder="例）2件" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">他者借入金額<span class="f_required">必須</span></dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_borrowing_num2" name="your_borrowing_num2" value="{{ $ov('your_borrowing_num2') }}" placeholder="例）100万円" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">希望連絡時間帯<span class="f_required">必須</span></dt>
                  <dd>
                      <select name="time" id="time" class="chk validate[required]">
                          <option value="">選択してください</option>
                          @foreach (config('custom.connect') as $tid => $tlabel)
                          <option value="{{ $tid }}" {{ (string) $ov('time') === (string) $tid ? 'selected' : '' }}>{{ $tlabel }}</option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="any">
                  <dt class="f_title other_free">その他ご要望など<span class="f_free">任意</span></dt>
                  <dd>
                      <textarea name="your_message" id="your_message">{{ $ov('your_message') }}</textarea>
                  </dd>
              </dl>

              <div class="checkbox-wrapper flex">
                <input class="check validate[required]" type="checkbox" name="個人情報保護方針" value="同意する" id="agreement" {{ old('個人情報保護方針') === '同意する' ? 'checked' : '' }}>
                <label for="agreement">
                  <p class="checkbox-txt f_text">
                    当サイトを金融業者ではなく、ご紹介サイトと理解して送信する事に同意する。
                  </p>
                </label>
              </div>
              <div class="formErrorContent checkbox-valid f_text">
                * チェックボックスをチェックしてください<br />
              </div>

              <div class="submit-wrapper">
                  <input type="submit" class="btn_submit" id="send" value="確認画面へ" />
              </div>
          </form>
      </div>
    </section>

  </div>
</body>
</html>
