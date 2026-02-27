<!DOCTYPE html>
<html lang="jp">

<head>
    <!-- Google Tag Manager -->
	<!-- Google tag (gtag.js) --> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16684548343"></script> 
     <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16684548343'); </script>
	<!-- End Google Tag Manager -->
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@600&family=Outfit:wght@500&display=swap"
		rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="{{ asset('front/js/script.js') }}"></script>
	<title>アシスト</title>
	<link rel="stylesheet" href="{{ asset('front/css/validationEngine.jquery.css') }}" />
</head>

<body>
	
	
	<header id="header">
		<div class="header-wrapper">
			<h1 class="header-logo">
				<a href="#main" class="header-logo-content">
					<img src="{{asset('front/img')}}/logo.png" alt="logo" />
				</a>
			</h1>
			<button type="button" class="mobile-nav-toggle">
				<span class="toggle-icon">
					<span></span><span></span><span></span>
				</span>
			</button>
		</div>
	</header>
	<div id="mobile-nav">
		<nav class="mobile-nav-container">
			<ul class="mobile-nav-menu">
				<li>
					<a href="#main" class="menu-link">
						<span class="jp">TOP</span>
					</a>
				</li>
				<li>
					<a href="#product" class="menu-link">
						<span class="jp">商品内容</span>
					</a>
				</li>
				<li>
					<a href="#workflow" class="menu-link">
						<span class="jp">ご融資完了までの流れ</span>
					</a>
				</li>
				<li>
					<a href="{{route('form_index')}}" class="menu-link">
						<span class="jp">お申込フォーム</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<main id="main">
		<section id="mainvisual" class="mainvisual">
			<div class="mainvisual-wrapper">
				<img class="main-img"  src="{{asset('front/img')}}/FV.jpg" alt="First View">
			</div>
			<!-- <div class="application-wrapper">
				<a href="{{route('form_index')}}" class="link-btn">今すぐお申込み</a>
			</div> -->
		</section>

		<section class="problem-sec">
			<h2 class="pbm-tit">こんなお悩みがある方はご相談ください</h2>
			<ul class="pbm-feature">
				<li class="feature-item">ブラック<br />だけどお金<br />が借りたい</li>
				<li class="feature-item">
					お金を借り<br />に行く時間<br />がない...
				</li>
				<li class="feature-item">
					他社から断<br />られたけど<br />お金が必要
				</li>
				<li class="feature-item">身内に知ら<br />れずに借り<br />たい...</li>
			</ul>
			<h3 class="pbm-desc">
				アシストでは様々なお悩みに<br />
				お応え出来る業者を厳選！！
			</h3>
		</section>

		<section class="product-content" id="product">
			<div class="triangle">
				<p class="triangle-txt">商品内容例</p>
			</div>
			<div class="table-wrapper">
				<table class="product-table">
					<tbody>
						<tr>
							<td>商品名</td>
							<td>即日フリープラン</td>
						</tr>
						<tr>
							<td>ご融資額</td>
							<td>30万円まで</td>
						</tr>
						<tr>
							<td>使　　途</td>
							<td>原則自由</td>
						</tr>
						<tr>
							<td>貸付利率</td>
							<td>
								15.00% 〜19.94%<br />
								（実質年率）
							</td>
						</tr>
						<tr>
							<td>遅延利率</td>
							<td>19.94% （実質年率）</td>
						</tr>
						<tr>
							<td>
								返済方式・<br />
								期間・回数
							</td>
							<td>
								残高スライドリボルビング　契約日より5年60回<br />
								元利均等返済（2-180回SM15年以内） <br />
								※ご相談の上、返済回数を設定します。
							</td>
						</tr>
						<tr>
							<td>
								担保・<br />
								保証人
							</td>
							<td>原則不要</td>
						</tr>
					</tbody>
				</table>
				<div class="product-attention">
					<p class="attention-txt">
						※商品プランは例となります。各業者から貸付条件を確認<br />
						して計画的にご利用してください
					</p>
					<p class="attention-txt">
						※当サイトでは直接貸付などは一切行っておりません。<br />
						条件のご相談などは各社に行ってください。
					</p>
					<p class="attention-txt">
						※必ずしも借りられるわけではございません。
					</p>
				</div>
				<a href="#example" class="link-btn">返済シミュレーションを見る</a>
			</div>
		</section>

		<section class="workflow-sec" id="workflow">
			<h1 class="workflow-tit">ご融資完了までの流れ</h1>
			<h2 class="form-tit">お申込み</h2>
			<p class="form-desc">
				お申込みフォームに必要事項を<br />
				入力し送信してください。
			</p>
			<h3 class="btn-desc">最短１分で完了！</h3>
			<a href="{{route('form_index')}}" class="link-btn">
				今すぐお申込み
			</a>
			<div class="p-workflow">
				<h2 class="flow-tit">審査結果</h2>
				<p class="flow-desc">
					融資が可能な業者からメールか<br />
					電話にてお知らせが届きます。<br />
					連絡がとれるようにしておきましょう
				</p>
			</div>
			<div class="p-workflow">
				<h2 class="flow-tit">振込手続き完了</h2>
				<p class="flow-desc">
					ご自身の条件と見合う業者がみつかったら<br />
					各会社の手続きに従って融資を受けてください<br />
					最短即日融資を振込で実行してくれます。
				</p>
			</div>
		</section>

		<section class="usage-sec">
			<h2 class="usage-tit">
				利用前に知って安心！<br />
				こんな融資先が見つかる
			</h2>

			<div class="usage-item">
				<span class="item-number">1</span>
				<h2 class="item-tit">
					24時間すぐにご利用できます。<br />
					<span class="big-txt">ご融資金の即日振込み</span>
				</h2>
				<p class="item-desc">
					ブラックの方でも寛大な融資を行う<br />
					会社がほとんどです。申込みから最短１５分で<br />
					お振込みが完了します。<br />
					<span class="attention"> ※お申込み時間によっては対応不可 </span>
				</p>
			</div>

			<div class="usage-item">
				<span class="item-number">2</span>
				<h2 class="item-tit">
					ご都合に合わせて相談可能<br />
					<span class="big-txt">ご返済日について</span>
				</h2>
				<p class="item-desc">
					お給料日や5,10日など収入の目途について<br />
					相談に乗ってくれる会社が多く安心して利用<br />
					できます。<br />
					<span class="attention">
						※必ず希望の日程で返済できるとは限りません。
					</span>
				</p>
			</div>

			<div class="usage-item">
				<span class="item-number">3</span>
				<h2 class="item-tit">
					金融事故者でも寛大審査<br />
					<span class="big-txt">貸付条件について</span>
				</h2>
				<p class="item-desc">
					債務整理や自己破産などの経験があっても<br />
					寛大に融資を行ってくれる会社が多いです。<br />
					過去の融資率は９０％以上です。<br />
				</p>
			</div>
			<h3 class="btn-desc">最短１分で完了！</h3>
			<a href="{{route('form_index')}}" class="link-btn">
				今すぐお申込み
			</a>
		</section>

		<section class="org-sec" id="example">
			<div>
				<h3>実際に１０万円借りた場合の返済フロー例</h3>
				<table class="org-table">
					<tbody>
						<tr>
							<td>回数</td>
							<td>返済金</td>
							<td>元金</td>
							<td>利息</td>
							<td>残高</td>
						</tr>
						<tr>
							<td>1</td>
							<td>10,000円</td>
							<td>8,750円</td>
							<td>1,250円</td>
							<td>91,250円</td>
						</tr>
						<tr>
							<td>2</td>
							<td>10,000円</td>
							<td>8,860円</td>
							<td>1,140円</td>
							<td>82,390円</td>
						</tr>
						<tr>
							<td>3</td>
							<td>10,000円</td>
							<td>8,971円</td>
							<td>1,029円</td>
							<td>73,419円</td>
						</tr>
						<tr>
							<td>4</td>
							<td>10,000円</td>
							<td>9,083円</td>
							<td>917円</td>
							<td>64,336円</td>
						</tr>
						<tr>
							<td>5</td>
							<td>10,000円</td>
							<td>9,196円</td>
							<td>804円</td>
							<td>55,140円</td>
						</tr>
						<tr>
							<td>6</td>
							<td>10,000円</td>
							<td>9,311円</td>
							<td>689円</td>
							<td>45,829円</td>
						</tr>
						<tr>
							<td>7</td>
							<td>10,000円</td>
							<td>9,428円</td>
							<td>572円</td>
							<td>36,401円</td>
						</tr>
						<tr>
							<td>8</td>
							<td>10,000円</td>
							<td>9,545円</td>
							<td>455円</td>
							<td>26,856円</td>
						</tr>
						<tr>
							<td>9</td>
							<td>10,000円</td>
							<td>9,665円</td>
							<td>335円</td>
							<td>17,191円</td>
						</tr>
						<tr>
							<td>10</td>
							<td>10,000円</td>
							<td>9,786円</td>
							<td>214円</td>
							<td>7,405円</td>
						</tr>
						<tr>
							<td>11</td>
							<td>7,497円</td>
							<td>7,405円</td>
							<td>92円</td>
							<td>0円</td>
						</tr>
					</tbody>
				</table>
				<ul class="table-desc">
					<li>支払い総額107,497円</li>
					<li>
						主な返済例 (実質年率15.00％で10万円を借り、<br />30日ごとに1万円ずつ返済する場合)
					</li>
					<li>※必ず上記の年率で融資が受けられるわけではありません。</li>
				</ul>
			</div>
		</section>
	</main>

	<footer id="footer">
		<div class="fm">
			<a class="footer-link" href="{{route('disclaimer')}}" target="_blank">
				免責 |
			</a>
			<a class="footer-link" href="{{route('policy')}}" target="_blank">
				プライバシーポリシー |
			</a>
			<a class="footer-link" href="{{route('form_index')}}">
				お問い合わせ |
			</a>
			<a class="footer-link" href="{{route('information')}}" target="_blank">
				運営者情報
			</a>
		</div>
		<!-- <div class="fm">
			<a class="footer-link" href="disclaimer.html" target="_blank">
				<img src="{{asset('front/img')}}/disclaimer.png" alt="免責事項">
			</a>
			<a class="footer-link" href="policy.html" target="_blank">
				<img src="{{asset('front/img')}}/policy.png" alt="プライバシーポリシー">
			</a>
		</div>
		<div class="fm">
			<a class="footer-link" href="{{route('form_index')}}">
				<img src="{{asset('front/img')}}/inquiry.png" alt="お問い合わせ">
			</a>
			<a class="footer-link" href="information.html" target="_blank">
				<img src="{{asset('front/img')}}/information.png" alt="運営者情報">
			</a>
		</div> -->
		<p class="copyright center">
			Copyright ©2024 Assist All Rights Reserved.
		</p>
	</footer>

	<div class="fixed-CTA">
		<a href="{{route('form_index')}}" class="link-btn">
			今すぐお申込み
			<img src="{{asset('front/img')}}/edit.png" alt="編集">
		</a>
	</div>

	<script src="{{asset('front/js')}}/common.js"></script>
	<script src="{{asset('front/js')}}/core.js"></script>
	<script src="{{asset('front/js')}}/jquery.easing.min.js"></script>
	<script src="{{asset('front/js')}}/jquery.jpostal.js"></script>
	<script src="{{asset('front/js')}}/jquery.validationEngine.js"></script>
	<script src="{{asset('front/js')}}/jquery.validationEngine-ja.js"></script>

	<script src="{{asset('front/js')}}/remodal.min.js"></script>
	<script src="{{asset('front/js')}}/set.js"></script>

	<script>
		$(document).ready(function () {
			const mediaQuery = window.matchMedia("(max-width: 640px)");
			const parentDiv = document.getElementById("bg_flow");
			const flowDiv = document.getElementById("flow");
			const childImg = document.getElementById("bg_flow_img");
			const spCildImg = document.getElementById("bg_flow_img_sp");

			if (mediaQuery.matches) {
				parentDiv.style.height = spCildImg.clientHeight + "px";
				flowDiv.style.height = spCildImg.clientHeight + "px";
			}
		});
	</script>
</body>

</html>