<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<title>&iquest;Hay subtes? | Estado del subte de Buenos Aires. Lineas A B C D E H P</title>
	<link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<link rel="apple-touch-icon" href="assets/images/fblogo.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/fblogo.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/fblogo.png">

	<link rel="stylesheet" href="assets/css/add2home.css">
	<script type="text/javascript" src="assets/js/add2home.js" charset="utf-8"></script>

	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta name="description" content="Conocé el estado del Subte de Buenos Aires. Lineas A B C D E H y Premetro. Se actualiza cada 2 minutos."/>
	<meta property="og:title" content="&iquest;Hay subtes? | Estado del subte de Buenos Aires. Lineas A B C D E H P"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="http://www.haysubtes.com/assets/images/fblogo.png"/>
	<meta property="og:url" content="http://www.haysubtes.com/"/>
	<meta property="og:site_name" content="HaySubtes.com"/>
	<meta property="fb:app_id" content="474696555902114"/>
</head>

<body>
	<!-- Facebook JS SDK -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1&appId=474696555902114";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<header>
		<h1 class="titulo">&iquest;Hay subtes?</h1>
	</header>

	<div class="estado-general">
		{{ $subte->getGlobalStatus() }}
	</div>

	@yield('lineas')

	<!--
	<div class="advertencia">
	<div class="logoLeft"></div>
	<div class="info"><span class="title">Paro escalonado 06/12:</span><span class="lineaA"> Linea A:</span> 08 - 10 hs. | <span class="lineaB">Linea B:</span> 10 - 12 hs. | <span class="lineaC">Linea C:</span> 12 - 14 hs. |  <span class="lineaD">Linea D:</span> 14 - 16 hs. | <span class="lineaE">Linea E:</span> 16 - 18 hs. | <span class="lineaH">Linea H:</span> 16 - 18 hs. | <span class="lineaP">Premetro:</span> 16 - 18 hs.</div>
	<div style="clear: both"></div>
	</div>
	-->

	<div style="clear: both"></div>
	<footer>
		<div class="social">
			<a href="https://twitter.com/share" class="twitter-share-button" data-text="{{ $subte->getTweetText() }}" data-lang="es">Twittear</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

			<div class="fb-like" data-href="http://www.haysubtes.com" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>

			{{--
			<a class="github-button" href="https://github.com/HaySubtes/hay-subtes-website" data-count-href="/HaySubtes/hay-subtes-website/watchers"
				data-count-api="/repos/HaySubtes/hay-subtes-website#subscribers_count" data-count-aria-label="# watchers on GitHub"
				aria-label="Watch HaySubtes/hay-subtes-website on GitHub">GitHub</a>
			<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
			--}}
		</div>

		<div class="texto-bonito"><p>El estado de subtes de <a href="http://www.haysubtes.com">haysubtes.com</a> se actualiza cada 2 minutos. :)</p></div>

		<div class="quote">
			<a href="https://twitter.com/celestineia" target="_blank">Cerebro</a> - 
			<a href="https://twitter.com/aguagraphics" target="_blank">Art</a> - 
			<a href="https://twitter.com/blaquened" target="_blank">Layout</a> - 
			Pinky - 
			<a href="https://twitter.com/chompas" target="_blank">Master Shake</a> - 
			<a href="https://twitter.com/alemohamad" target="_blank">Handyman</a>
		</div>
	</footer>

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36787848-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

</body>
</html>
