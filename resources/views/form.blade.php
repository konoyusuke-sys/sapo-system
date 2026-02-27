<!DOCTYPE html>
<html lang="jp">
  <head>
    <!-- Google Tag Manager -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16684548343"></script> 
    <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16684548343'); </script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('front/css')}}/style.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@600&family=Outfit:wght@500&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{asset('front/js')}}/script.js"></script>
    <script src="{{asset('front/js')}}/validation.js"></script>
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="{{asset('front/css')}}/validationEngine.jquery.css" />
    <script>
      function tosubmit() {
        // Getting the value of your text input
        let ans = [];
        let inputArray = document.getElementsByTagName("input");
        for (i = 0; i < inputArray.length; i++) {
          // if(inputArray[i].getAttribute('name')== null) continue;
          ans.push({
            name: inputArray[i].getAttribute("name"),
            value: inputArray[i].value,
          });
        }
        let selectArray = document.getElementsByTagName("select");
        for (let i = 0; i < selectArray.length; i++) {
          ans.push({
            name: selectArray[i].getAttribute("name"),
            value: selectArray[i].value,
          });
        }
        let textArray = document.getElementsByTagName("textarea");
        for (let i = 0; i < textArray.length; i++) {
          ans.push({
            name: textArray[i].getAttribute("name"),
            value: textArray[i].value,
          });
        }

        localStorage.setItem("person-info", JSON.stringify(ans));
        localStorage.setItem("formSubmitted", 'display');
        return true;
      }
    </script>
  </head>
</html>

<body>
  
  
  <main>
    <section id="application" class="application-sec">
      <h2 class="line">お申込フォーム</h2>
      <div class="">
          <form name="lifeform" method="post" onsubmit="tosubmit();" action="{{route('display')}}"
              enctype="multipart/form-data" class="area_form h-adr" id="docform" novalidate>
              @csrf
              <dl class="req">
                  <dt>お名前</dt>
                  <dd class="col2">
                      <span>姓
                          <input class="chk w50 validate[required]" type="text" id="your_name_sei" name="name_sei"
                              value="" placeholder="例）○○" /></span>
                      <span>名
                          <input class="chk w50 validate[required]" type="text" id="your_name_mei" name="name_mei"
                              value="" placeholder="例）●●" /></span>
                  </dd>
              </dl>

              <dl class="req">
                  <dt>お名前（ふりがな）</dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="your_name_kana" name="name_kana" value=""
                          placeholder="例）○○ ●●" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt>メールアドレス</dt>
                  <dd>
                      <input type="email" class="chk validate[required,custom[email]] m_b5" id="your_mail"
                          name="your_mail" value="" placeholder="例）○○○○@▲▲▲▲▲.jp " />
                  </dd>
              </dl>

              <dl class="any">
                  <dt>LINE ID</dt>
                  <dd>
                      <input type="text" class="" id="your_line" name="your_line" value="" placeholder="例）abcd1234" />
                      <p class="caption">
                          半角英数字で入力してください<br />
                          <em>※LINE登録ですとスムーズにやりとりが可能になります。</em>
                      </p>
                  </dd>
              </dl>

              <dl class="req">
                  <dt>生年月日</dt>
                  <dd class="">
                      <div class="row col3 w500">
                          <span class="birthday">
                              <select name="birth_year" id="birth" class="chk validate[required]">
                                  <option value="" {$selected.default}>----</option>
                                  <option value="1940" {$selected.生年.1940年(昭和15年)}>
                                      1940(昭和15)
                                  </option>
                                  <option value="1941" {$selected.生年.1941年(昭和16年)}>
                                      1941(昭和16)
                                  </option>
                                  <option value="1942" {$selected.生年.1942年(昭和17年)}>
                                      1942(昭和17)
                                  </option>
                                  <option value="1943" {$selected.生年.1943年(昭和18年)}>
                                      1943(昭和18)
                                  </option>
                                  <option value="1944" {$selected.生年.1944年(昭和19年)}>
                                      1944(昭和19)
                                  </option>
                                  <option value="1945" {$selected.生年.1945年(昭和20年)}>
                                      1945(昭和20)
                                  </option>
                                  <option value="1946" {$selected.生年.1946年(昭和21年)}>
                                      1946(昭和21)
                                  </option>
                                  <option value="1947" {$selected.生年.1947年(昭和22年)}>
                                      1947(昭和22)
                                  </option>
                                  <option value="1948" {$selected.生年.1948年(昭和23年)}>
                                      1948(昭和23)
                                  </option>
                                  <option value="1949" {$selected.生年.1949年(昭和24年)}>
                                      1949(昭和24)
                                  </option>
                                  <option value="1950" {$selected.生年.1950年(昭和25年)}>
                                      1950(昭和25)
                                  </option>
                                  <option value="1951" {$selected.生年.1951年(昭和26年)}>
                                      1951(昭和26)
                                  </option>
                                  <option value="1952" {$selected.生年.1952年(昭和27年)}>
                                      1952(昭和27)
                                  </option>
                                  <option value="1953" {$selected.生年.1953年(昭和28年)}>
                                      1953(昭和28)
                                  </option>
                                  <option value="1954" {$selected.生年.1954年(昭和29年)}>
                                      1954(昭和29)
                                  </option>
                                  <option value="1955" {$selected.生年.1955年(昭和30年)}>
                                      1955(昭和30)
                                  </option>
                                  <option value="1956" {$selected.生年.1956年(昭和31年)}>
                                      1956(昭和31)
                                  </option>
                                  <option value="1957" {$selected.生年.1957年(昭和32年)}>
                                      1957(昭和32)
                                  </option>
                                  <option value="1958" {$selected.生年.1958年(昭和33年)}>
                                      1958(昭和33)
                                  </option>
                                  <option value="1959" {$selected.生年.1959年(昭和34年)}>
                                      1959(昭和34)
                                  </option>
                                  <option value="1960" {$selected.生年.1960年(昭和35年)}>
                                      1960(昭和35)
                                  </option>
                                  <option value="1961" {$selected.生年.1961年(昭和36年)}>
                                      1961(昭和36)
                                  </option>
                                  <option value="1962" {$selected.生年.1962年(昭和37年)}>
                                      1962(昭和37)
                                  </option>
                                  <option value="1963" {$selected.生年.1963年(昭和38年)}>
                                      1963(昭和38)
                                  </option>
                                  <option value="1964" {$selected.生年.1964年(昭和39年)}>
                                      1964(昭和39)
                                  </option>
                                  <option value="1965" {$selected.生年.1965年(昭和40年)}>
                                      1965(昭和40)
                                  </option>
                                  <option value="1966" {$selected.生年.1966年(昭和41年)}>
                                      1966(昭和41)
                                  </option>
                                  <option value="1967" {$selected.生年.1967年(昭和42年)}>
                                      1967(昭和42)
                                  </option>
                                  <option value="1968" {$selected.生年.1968年(昭和43年)}>
                                      1968(昭和43)
                                  </option>
                                  <option value="1969" {$selected.生年.1969年(昭和44年)}>
                                      1969(昭和44)
                                  </option>
                                  <option value="1970" {$selected.生年.1970年(昭和45年)}>
                                      1970(昭和45)
                                  </option>
                                  <option value="1971" {$selected.生年.1971年(昭和46年)}>
                                      1971(昭和46)
                                  </option>
                                  <option value="1972" {$selected.生年.1972年(昭和47年)}>
                                      1972(昭和47)
                                  </option>
                                  <option value="1973" {$selected.生年.1973年(昭和48年)}>
                                      1973(昭和48)
                                  </option>
                                  <option value="1974" {$selected.生年.1974年(昭和49年)}>
                                      1974(昭和49)
                                  </option>
                                  <option value="1975" {$selected.生年.1975年(昭和50年)}>
                                      1975(昭和50)
                                  </option>
                                  <option value="1976" {$selected.生年.1976年(昭和51年)}>
                                      1976(昭和51)
                                  </option>
                                  <option value="1977" {$selected.生年.1977年(昭和52年)}>
                                      1977(昭和52)
                                  </option>
                                  <option value="1978" {$selected.生年.1978年(昭和53年)}>
                                      1978(昭和53)
                                  </option>
                                  <option value="1979" {$selected.生年.1979年(昭和54年)}>
                                      1979(昭和54)
                                  </option>
                                  <option value="1980" {$selected.生年.1980年(昭和55年)}>
                                      1980(昭和55)
                                  </option>
                                  <option value="1981" {$selected.生年.1981年(昭和56年)}>
                                      1981(昭和56)
                                  </option>
                                  <option value="1982" {$selected.生年.1982年(昭和57年)}>
                                      1982(昭和57)
                                  </option>
                                  <option value="1983" {$selected.生年.1983年(昭和58年)}>
                                      1983(昭和58)
                                  </option>
                                  <option value="1984" {$selected.生年.1984年(昭和59年)}>
                                      1984(昭和59)
                                  </option>
                                  <option value="1985" {$selected.生年.1985年(昭和60年)}>
                                      1985(昭和60)
                                  </option>
                                  <option value="1986" {$selected.生年.1986年(昭和61年)}>
                                      1986(昭和61)
                                  </option>
                                  <option value="1987" {$selected.生年.1987年(昭和62年)}>
                                      1987(昭和62)
                                  </option>
                                  <option value="1988" {$selected.生年.1988年(昭和63年)}>
                                      1988(昭和63)
                                  </option>
                                  <option value="1989" {$selected.生年.1989年(昭和64年平成1年)}>
                                      1989(昭和64/平成1)
                                  </option>
                                  
                                  <option value="1990" {$selected.生年.1990年(平成2年)}>
                                      1990(平成2)
                                  </option>
                                  <option value="1991" {$selected.生年.1991年(平成3年)}>
                                      1991(平成3)
                                  </option>
                                  <option value="1992" {$selected.生年.1992年(平成4年)}>
                                      1992(平成4)
                                  </option>
                                  <option value="1993" {$selected.生年.1993年(平成5年)}>
                                      1993(平成5)
                                  </option>
                                  <option value="1994" {$selected.生年.1994年(平成6年)}>
                                      1994(平成6)
                                  </option>
                                  <option value="1995" {$selected.生年.1995年(平成7年)}>
                                      1995(平成7)
                                  </option>
                                  <option value="1996" {$selected.生年.1996年(平成8年)}>
                                      1996(平成8)
                                  </option>
                                  <option value="1997" {$selected.生年.1997年(平成9年)}>
                                      1997(平成9)
                                  </option>
                                  <option value="1998" {$selected.生年.1998年(平成10年)}>
                                      1998(平成10)
                                  </option>
                                  <option value="1999" {$selected.生年.1999年(平成11年)}>
                                      1999(平成11)
                                  </option>

                                  <option value="2000" {$selected.生年.2000年(平成12年)}>
                                      2000(平成12)
                                  </option>
                                  <option value="2001" {$selected.生年.2001年(平成13年)}>
                                      2001(平成13)
                                  </option>
                                  <option value="2002" {$selected.生年.2002年(平成14年)}>
                                      2002(平成14)
                                  </option>
                                  <option value="2003" {$selected.生年.2003年(平成15年)}>
                                      2003(平成15)
                                  </option>
                                  <option value="2004" {$selected.生年.2004年(平成16年)}>
                                      2004(平成16)
                                  </option>
                              </select>年
                          </span>

                          <span class="birthday">
                              <select name="birth_month" class="chk validate[required]">
                                  <option value="" {$selected.default}>----</option>
                                  <option value="1" {$selected.生月.1}>1</option>
                                  <option value="2" {$selected.生月.2}>2</option>
                                  <option value="3" {$selected.生月.3}>3</option>
                                  <option value="4" {$selected.生月.4}>4</option>
                                  <option value="5" {$selected.生月.5}>5</option>
                                  <option value="6" {$selected.生月.6}>6</option>
                                  <option value="7" {$selected.生月.7}>7</option>
                                  <option value="8" {$selected.生月.8}>8</option>
                                  <option value="9" {$selected.生月.9}>9</option>
                                  <option value="10" {$selected.生月.10}>10</option>
                                  <option value="11" {$selected.生月.11}>11</option>
                                  <option value="12" {$selected.生月.12}>12</option>
                              </select>
                              月
                          </span>

                          <span class="birthday">
                              <select name="birth_date" class="chk validate[required]">
                                  <option value="" {$selected.default}>----</option>
                                  <option value="1" {$selected.生日.1}>1</option>
                                  <option value="2" {$selected.生日.2}>2</option>
                                  <option value="3" {$selected.生日.3}>3</option>
                                  <option value="4" {$selected.生日.4}>4</option>
                                  <option value="5" {$selected.生日.5}>5</option>
                                  <option value="6" {$selected.生日.6}>6</option>
                                  <option value="7" {$selected.生日.7}>7</option>
                                  <option value="8" {$selected.生日.8}>8</option>
                                  <option value="9" {$selected.生日.9}>9</option>
                                  <option value="10" {$selected.生日.10}>10</option>
                                  <option value="11" {$selected.生日.11}>11</option>
                                  <option value="12" {$selected.生日.12}>12</option>
                                  <option value="13" {$selected.生日.13}>13</option>
                                  <option value="14" {$selected.生日.14}>14</option>
                                  <option value="15" {$selected.生日.15}>15</option>
                                  <option value="16" {$selected.生日.16}>16</option>
                                  <option value="17" {$selected.生日.17}>17</option>
                                  <option value="18" {$selected.生日.18}>18</option>
                                  <option value="19" {$selected.生日.19}>19</option>
                                  <option value="20" {$selected.生日.20}>20</option>
                                  <option value="21" {$selected.生日.21}>21</option>
                                  <option value="22" {$selected.生日.22}>22</option>
                                  <option value="23" {$selected.生日.23}>23</option>
                                  <option value="24" {$selected.生日.24}>24</option>
                                  <option value="25" {$selected.生日.25}>25</option>
                                  <option value="26" {$selected.生日.26}>26</option>
                                  <option value="27" {$selected.生日.27}>27</option>
                                  <option value="28" {$selected.生日.28}>28</option>
                                  <option value="29" {$selected.生日.29}>29</option>
                                  <option value="30" {$selected.生日.30}>30</option>
                                  <option value="31" {$selected.生日.31}>31</option>
                              </select>
                              日
                          </span>
                      </div>
                  </dd>
              </dl>
              <span class="p-country-name" style="display: none">Japan</span>
              <dl class="req">
                  <dt>郵便番号</dt>
                  <dd>
                      <input class="p-postal-code validate[required] chk" type="text" id="your_postnum" name="your_postnum"
                          value="" />
                  </dd>
              </dl>
              <dl class="req">
                  <dt>都道府県</dt>
                  <dd>
                    <select name="pref_id" id="pref_id" class="chk validate[required]">
                        <option value="" {$selected.default}>選択してください</option>
                          @foreach(config('custom.prefecture') as $key => $val)
                          <option value="{{$key}}" >
                              {{$val}}
                          </option>
                          @endforeach
                    </select>
                  </dd>
              </dl>
              <dl class="req">
                  <dt>市区町村</dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="addr1" name="addr1" value=""
                          placeholder="例）○○市" />
                  </dd>
              </dl>
              <dl class="req">
                  <dt>番地等</dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="addr2" name="addr2" value=""
                          placeholder="例）0丁目" />
                      
                  </dd>
              </dl>
              <dl class="any">
                  <dt>建物名・部屋番号</dt>
                  <dd>
                      <input class=" " type="text" id="addr3" name="addr3" value=""
                          placeholder="0-00" />
                      <p class="caption">
                          <em>※建物名がない方はなしと記入してください</em>
                      </p>
                  </dd>
              </dl>
              <dl class="req">
                  <dt>携帯電話番号</dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_mobile" name="your_mobile" value=""
                          placeholder="例）08012341234" />
                      <p class="caption">
                          半角英数字で入力してください<br /><em>※通電確認が取れないと融資が行えませんのでご注意ください。</em>
                      </p>
                  </dd>
              </dl>
              <dl class="any">
                  <dt>固定電話番号</dt>
                  <dd>
                      <input class="" type="text" id="your_tel" name="your_tel" value="" placeholder="例）0312345678" />
                      <p class="caption">半角英数字で入力してください</p>
                  </dd>
              </dl>
              <dl class="req">
                  <dt>職業</dt>
                  <dd>
                      <select name="job" id="job" class="chk validate[required]">
                          <option value="" {$selected.default}>選択してください</option>
                          
                          @foreach(config('custom.job') as $key => $val)
                          <option value="{{$key}}" >
                              {{$val}}
                          </option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="req">
                  <dt>勤務先名</dt>
                  <dd>
                      <input class="chk validate[required]" type="text" id="your_company" name="your_company" value=""
                          placeholder="例）○○株式会社▲▲営業所" />
                  </dd>
              </dl>
              
              <dl class="req">
                  <dt>勤務先電話番号</dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_company_tel" name="your_company_tel" value=""
                          placeholder="例）0312345678" />
                      <p class="caption">半角英数字で入力してください</p>
                  </dd>
              </dl>

              <dl class="req">
                  <dt>月収</dt>
                  <dd>
                      <select name="income" id="income" class="chk validate[required]">
                          <option value="" {$selected.default}>選択してください</option>
                          <option value="10万円以下" {$selected.月収.10万円以下}>
                              10万円以下
                          </option>
                          <option value="11～20万円" {$selected.月収.11～20万円}>
                              11～20万円
                          </option>
                          <option value="21～30万円" {$selected.月収.21～30万円}>
                              21～30万円
                          </option>
                          <option value="31～40万円" {$selected.月収.31～40万円}>
                              31～40万円
                          </option>
                          <option value="41万円以上" {$selected.月収.41万円以上}>
                              41万円以上
                          </option>
                      </select>
                  </dd>
              </dl>

              <dl class="req">
                  <dt>借入希望金額</dt>
                  <dd>
                      <select name="desired_borrowing" id="desired_borrowing" class="chk validate[required]">
                          <option value="" {$selected.default}>選択してください</option>
                          @foreach(config('custom.expectation') as $key => $val)
                          <option value="{{$key}}" {$selected.借入希望金額.１万円}>
                              {{$val}}
                          </option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="req">
                  <dt>他者借入件数</dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_borrowing_num" name="your_borrowing_num" value=""
                          placeholder="例）2件" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt>他者借入金額</dt>
                  <dd>
                      <input class="validate[required] chk" type="text" id="your_borrowing_num2" name="your_borrowing_num2"
                          value="" placeholder="例）100万円" />
                  </dd>
              </dl>

              <dl class="req">
                  <dt>希望連絡時間帯</dt>
                  <dd>
                      <select name="time" id="time" class="chk validate[required]">
                          <option value="">選択してください</option>
                          
                          @foreach(config('custom.connect') as $key => $val)
                          <option value="{{$key}}" >
                              {{$val}}
                          </option>
                          @endforeach
                      </select>
                  </dd>
              </dl>

              <dl class="any">
                  <dt>その他ご要望など</dt>
                  <dd>
                      <textarea name="your_message" id="your_message"></textarea>
                  </dd>
              </dl>

              <div class="checkbox-wrapper">
                  <div class="agreementformError parentFormform formError">
                    <div class="formErrorArrow formErrorArrowBottom">
                      <div class="line1"></div>
                      <div class="line2"></div>
                      <div class="line3"></div>
                      <div class="line4"></div>
                      <div class="line5"></div>
                      <div class="line6"></div>
                      <div class="line7"></div>
                      <div class="line8"></div>
                      <div class="line9"></div>
                      <div class="line10"></div>
                    </div>
                  </div>
                <input type="checkbox" name="個人情報保護方針" value="同意する" id="agreement" class="validate[required]">
                <label for="agreement">
                  <p class="checkbox-txt">
                    当サイトを金融業者ではなく、ご紹介サイトと理解して送信する事に同意する。
                  </p>
                </label>
              </div>
              <div class="formErrorContent checkbox-valid">
                * チェックボックスをチェックしてください<br />
              </div>

              <div class="submit-wrapper">
                  <input type="button" class="btn_submit" id="send" value="確認画面へ" />
              </div>
          </form>
      </div>
    </section>
  </main>
</body>
