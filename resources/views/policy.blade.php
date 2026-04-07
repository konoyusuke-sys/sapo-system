<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>カリマッチ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TS8QB62V');</script>
</head>

<body class="sp_policy">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TS8QB62V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <div class="sp_policy_container sp_container">

    <header class="flex">
      <div class="headertitlecrm widthhalf">
        <a href="{{ url('/') }}"><img src="{{ asset('image/header_title.png') }}" class="header_title" alt="カリマッチ"></a>
      </div>
      <div class="headerctacrm widthhalf">
        <a href="{{ route('form_index') }}"><img src="{{ asset('image/header_cta.png') }}" class="header_cta" alt="お申込み"></a>
      </div>
    </header>

    <div class="policy_sec01">
      <div>
        <p class="p_title">プライバシーポリシー</p>
      </div>
      <div>
        <p class="p_text">カリマッチ（以下「当社」といいます）は、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識 と取り組みを徹底させることにより、個人情報の保護を推進いたします。</p>
        <p class="p_sub">個人情報の利用目的</p>
        <p class="p_text">お客さまからお預かりした個人情報は、当社からのご連絡や業務のご案内やご質問に対する回答として、電子メールや資料のご送付に利用いたします。</p>
        <p class="p_sub">個人情報の第三者への開示・提供の禁止</p>
        <p class="p_text">当社はお客さまよりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。
          お客さまの同意がある場合
          お客さまがご希望のサービスを行うために当社が業務を委託する業者に対して開示する場合
        法令に基づき開示が必要である場合</p>
        <p class="p_sub">個人情報の安全対策</p>
        <p class="p_text">当社は、個人情報の正確性及び安全性確保の為に、セキュリティに万全の対策を講じています。</p>
        <p class="p_sub">ご本人の照会</p>
        <p class="p_text">お客さまがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認のうえ、対応させていただきます</p>
        <p class="p_sub">法令、規範の遵守と見直し</p>
        <p class="p_text">当社は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、本ポリシーの内容を常に見直し、その改善に努めます。</p>
        <p class="p_sub">ご紹介できる中小金融会社一覧</p>
        <img src="{{ asset('image/policy_img.png') }}" class="policy_img" alt="">
        <p class="p_text">※上記以外にも数十社と提携しています</p>
      </div>
    </div>

  </div>
</body>
</html>
