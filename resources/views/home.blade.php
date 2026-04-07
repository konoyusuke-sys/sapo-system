<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>カリマッチ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TS8QB62V');</script>
<!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TS8QB62V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <div class="sp_container">

    <header class="flex">
      <div class="headertitlecrm widthhalf">
        <a href="{{ url('/') }}"><img src="{{ asset('image/header_title.png') }}" class="header_title" alt="カリマッチ"></a>
      </div>
      <div class="headerctacrm widthhalf">
        <a href="{{ route('form_index') }}"><img src="{{ asset('image/header_cta.png') }}" class="header_cta" alt="お申込み"></a>
      </div>
    </header>

    <div class="fv">
      <img src="{{ asset('image/spkv.png') }}" class="spkv" alt="">
    </div>

    <div class="sec01">
      <div class="sec01container">
        <p class="title">こんな<span class="fup28">お悩み</span>ありませんか？</p>
        <img src="{{ asset('image/sec01il.png') }}" class="sec01il" alt="">
        <img src="{{ asset('image/sec01img.png') }}" class="sec01img" alt="">
      </div>
    </div>

    <div class="sec02">
      <div class="sec02container">
        <img src="{{ asset('image/sec02title.png') }}" class="sec02title" alt="">
        <div class="sec02box">
          <p class="sec02box_title">商品内容例</p>
          <div>

            <div class="contents01 flex">
              <div class="contents_left">
                <p>商品名</p>
              </div>
              <div class="contents_right">
                <p>即日フリープラン</p>
              </div>
            </div>

            <div class="contents01 flex">
              <div class="contents_left">
                <p>使途</p>
              </div>
              <div class="contents_right">
                <p>原則自由</p>
              </div>
            </div>

            <div class="contents01 flex">
              <div class="contents_left">
                <p>貸付利率</p>
              </div>
              <div class="contents_right">
                <p>15.00%~19.94%(実質年率)</p>
              </div>
            </div>

            <div class="contents01 flex">
              <div class="contents_left">
                <p>返済方式/<br>期間/回数</p>
              </div>
              <div class="contents_right">
                <p>残高スライドリボルビング<br>契約日より5年60回<br>元利均等返済(2-180回SM15年以内)<br>※ご相談の上、返済回数を設定します。</p>
              </div>
            </div>

            <div class="contents01 flex">
              <div class="contents_left">
                <p>担保/保証人</p>
              </div>
              <div class="contents_right">
                <p>15.00%~19.94%(実質年率)</p>
              </div>
            </div>

          </div>
        </div>
        <p class="annotation">※商品プランは例となります。各業者から貸付条件を確認して計画的にご利用してください<br>※当サイトでは直接貸付などは一切行っておりません。条件のご相談などは各社に行ってください。<br>※必ずしも借りられるわけではございません。</p>
        <button type="button" class="simulation" onclick="location.href='#sec05'">返済シミュレーションを見る</button>
      </div>
    </div>

    <div class="sec03">
      <div class="sec03container">
        <p class="title"><span class="fup28">ご融資完了</span>までの流れ</p>

        <div class="step_box">
          <img src="{{ asset('image/step01.png') }}" class="step01" alt="">
          <img src="{{ asset('image/step01il.png') }}" class="step01il" alt="">
          <p class="steptitle">お申し込み</p>
          <p class="steptext">お申込みフォームに必要事項を<br>入力し送信してください。</p>
          <a href="{{ route('form_index') }}"><img src="{{ asset('image/cta02.png') }}" class="cta02" alt="お申込み"></a>
        </div>

        <div class="step_box">
          <img src="{{ asset('image/step02.png') }}" class="step02" alt="">
          <img src="{{ asset('image/step02il.png') }}" class="step02il" alt="">
          <p class="steptitle">審査結果</p>
          <p class="steptext">融資が可能な業者から<br>メールか電話にてお知らせが届きます。<br>連絡がとれるようにしておきましょう</p>
        </div>

        <div class="step_box">
          <img src="{{ asset('image/step03.png') }}" class="step03" alt="">
          <img src="{{ asset('image/step03il.png') }}" class="step03il" alt="">
          <p class="steptitle">振込手続き完了</p>
          <p class="steptext">ご自身の条件と見合う業者がみつかったら<br>各会社の手続きに従って融資を受けてください<br>最短即日融資を振込で実行してくれます。</p>
        </div>

      </div>
    </div>

    <div class="sec04">
      <div class="sec04container">
        <p class="sec04_title">利用前に知って安心！<br>こんな融資先が見つかる</p>
        <img src="{{ asset('image/sec04il01.png') }}" class="sec04il01" alt="">
        <img src="{{ asset('image/sec04il02.png') }}" class="sec04il02" alt="">
        <img src="{{ asset('image/sec04il03.png') }}" class="sec04il03" alt="">
        <a href="{{ route('form_index') }}"><img src="{{ asset('image/cta02.png') }}" class="cta02" alt="お申込み"></a>
      </div>
    </div>

    <div id="sec05" class="sec05">
      <div class="sec05container">
        <img src="{{ asset('image/sec04text.png') }}" class="sec04text" alt="">
        <img src="{{ asset('image/graph.png') }}" class="graph" alt="">
        <p class="annotation">支払い総額107,497円<br>主な返済例 (実質年率15.00％で10万円を借り、30日ごとに1万円ずつ返済する場合)<br>※必ず上記の年率で融資が受けられるわけではありません。</p>
      </div>
    </div>

    <footer>
      <ul class="navi flex">
        <li><a href="{{ route('disclaimer') }}" class="navi_contents">免責</a></li>
        <li><a href="{{ route('policy') }}" class="navi_contents">プライバシーポリシー</a></li>
        <li><a href="{{ route('form_index') }}" class="navi_contents">お問い合わせ</a></li>
        <li><a href="{{ route('information') }}" class="navi_contents">運営者情報</a></li>
      </ul>
      <p class="copy">Copyright ©2024 カリマッチ All Rights Reserved.</p>
    </footer>

  </div>
</body>
</html>
