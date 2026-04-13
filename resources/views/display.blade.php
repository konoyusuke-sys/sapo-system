@php
  $pref = config('custom.prefecture');
  $job = config('custom.job');
  $expect = config('custom.expectation');
  $connect = config('custom.connect');
  $birthLabel = config('lead_form.birth_year_label');
@endphp
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>カリマッチ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
  <style>
    .submit-loading-overlay {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 99999;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      background: rgba(0, 0, 0, 0.55);
      -webkit-tap-highlight-color: transparent;
    }
    .submit-loading-overlay.is-visible { display: flex; }
    .submit-loading-box {
      width: 88%;
      max-width: 320px;
      padding: 1.5rem 1.25rem 1.75rem;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      text-align: center;
      box-sizing: border-box;
    }
    .submit-loading-spinner {
      width: 44px;
      height: 44px;
      margin: 0 auto 1rem;
      border: 4px solid #e8e8e8;
      border-top-color: #333;
      border-radius: 50%;
      animation: submit-spin 0.75s linear infinite;
    }
    @keyframes submit-spin {
      to { transform: rotate(360deg); }
    }
    .submit-loading-title {
      font-size: 1.1rem;
      font-weight: 700;
      margin: 0 0 0.5rem;
      color: #222;
    }
    .submit-loading-msg {
      font-size: 0.9rem;
      line-height: 1.55;
      margin: 0;
      color: #444;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('js/form.js') }}"></script>
<script type="text/javascript">
function showSubmitLoading() {
  var overlay = document.getElementById('submit-loading-overlay');
  if (overlay) {
    overlay.classList.add('is-visible');
    overlay.setAttribute('aria-hidden', 'false');
  }
}
function goNext()
{
  var btn = document.getElementById('send');
  if (btn) btn.disabled = true;
  showSubmitLoading();
  // 描画してから送信（真っ暗なまま待たせない）
  requestAnimationFrame(function () {
    requestAnimationFrame(function () {
      document.lifeform.submit();
    });
  });
}
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('docform');
  if (form) {
    form.addEventListener('submit', function () {
      showSubmitLoading();
    });
  }
});
</script>
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
    </header>

    <div class="form_sec01">
      <div>
        <p class="f_sectitle">お申込フォーム（確認）</p>
      </div>
    </div>

    <section id="application" class="application_sec">
      <div class="">
        <form name="lifeform" method="post" action="{{ route('post_form') }}" enctype="multipart/form-data" class="area_form h-adr" id="docform" novalidate>
          @csrf
          <input type="hidden" name="confirm_token" value="{{ $confirmToken }}">

            <dl class="req">
              <dt class="f_title">お名前<span class="f_required">必須</span></dt>
              <dd class="col2">
                <span class="f_text">姓&nbsp; {{ $lead['name_sei'] }} </span>
                <br>
                <span class="f_text">名&nbsp; {{ $lead['name_mei'] }} </span>
              </dd>
            </dl>

              <dl class="req">
                  <dt class="f_title">お名前（ふりがな）<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['name_kana'] }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">メールアドレス<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_mail'] }}</dd>
              </dl>

              <dl class="any">
                  <dt class="f_title">LINE ID<span class="f_free">任意</span></dt>
                  <dd>{{ $lead['your_line'] ?? '' }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">生年月日<span class="f_required">必須</span></dt>
                  <dd class="">
                      <div class="row col3 w500">
                          <span class="birthday">{{ $birthLabel[$lead['birth_year']] ?? $lead['birth_year'] }}年</span>
                          <span class="birthday">{{ $lead['birth_month'] }}月</span>
                          <span class="birthday">{{ $lead['birth_date'] }}日</span>
                      </div>
                  </dd>
              </dl>
              <span class="p-country-name" style="display: none">Japan</span>
              <dl class="req">
                  <dt class="f_title">郵便番号<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_postnum'] }}</dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">都道府県<span class="f_required">必須</span></dt>
                  <dd>{{ $pref[$lead['pref_id']] ?? '' }}</dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">市区町村<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['addr1'] }}</dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">番地等<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['addr2'] }}</dd>
              </dl>
              <dl class="any">
                  <dt class="f_title">建物名・部屋番号<span class="f_free">任意</span></dt>
                  <dd>{{ $lead['addr3'] ?? '' }}</dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">携帯電話番号<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_mobile'] }}</dd>
              </dl>
              <dl class="any">
                  <dt class="f_title">固定電話番号<span class="f_free">任意</span></dt>
                  <dd>{{ $lead['your_tel'] ?? '' }}</dd>
              </dl>
              <dl class="req">
                  <dt class="f_title">職業<span class="f_required">必須</span></dt>
                  <dd>{{ $job[$lead['job']] ?? '' }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">勤務先名<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_company'] }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">勤務先電話番号<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_company_tel'] }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">月収<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['income'] }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">借入希望金額<span class="f_required">必須</span></dt>
                  <dd>{{ $expect[$lead['desired_borrowing']] ?? '' }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">他者借入件数<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_borrowing_num'] }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">他者借入金額<span class="f_required">必須</span></dt>
                  <dd>{{ $lead['your_borrowing_num2'] }}</dd>
              </dl>

              <dl class="req">
                  <dt class="f_title">希望連絡時間帯<span class="f_required">必須</span></dt>
                  <dd>{{ $connect[$lead['time']] ?? '' }}</dd>
              </dl>

              <dl class="any">
                  <dt class="f_title other_free">その他ご要望など<span class="f_free">任意</span></dt>
                  <dd>{!! nl2br(e($lead['your_message'] ?? '')) !!}</dd>
              </dl>

              <div class="submit-wrapper">
                  <a href="{{ route('form_index', ['back' => 1]) }}" class="btn_submit" style="display:inline-block;width:49%;text-align:center;background-color:#404040;color:#fff;text-decoration:none;line-height:normal;box-sizing:border-box;padding:0.75em 0;">前に戻る</a>
                  <input type="submit" class="btn_submit" style="width:49%;" id="send" value="申込" onclick="goNext(); return false;"/>
              </div>
          </form>
      </div>
    </section>

  </div>
</body>
</html>
