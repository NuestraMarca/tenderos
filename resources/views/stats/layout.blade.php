<html>
	<head>
		<title>Proyecto juntos con el tendero</title>
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/main.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/themes.css">
		<link rel="stylesheet" href="/assets/css/plugins.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/landing.css">

		<style type="text/css">
			h2{
				text-align: center;
			    margin-top: 0;
			    color: #1E8D9F;
			    font-weight: 400;
			    margin-bottom: 1.5em;
			}
			h3.title-stat {
			    margin-top: 0;
			    margin-bottom: 1em;
			    font-size: 1.5em;
			    font-weight: 400;
			    border-bottom: none;
			    display: block;
			}
			ul li{
				margin-bottom: 0.2em;
			}
			ul li a{
				font-size: 1.3em;
			}
		</style>
	</head>
	<body>
		<div class="main">
			<h1 style="margin-bottom: 0.2em;"><a href="/" title="Volver al inicio" class="text-info">Proyecto juntos con el tendero</a></h1>
			<h2>@yield('title', 'Estadisticas')</h2>
			<div class="col-xs-12">
				
				@if(Auth::guest())
					<a href="/auth/register" class="btn btn-warning home-register">
						<i class="fa fa-plus-circle"></i> Registrarme
					</a>	
					<a href="/auth/login" class="btn btn-primary home-login">
						<i class="fa fa-check-circle"></i> Iniciar sesión
					</a>
				@else
					<a href="/auth/logout" class="btn btn-danger home-login">
						<i class="fa fa-times-circle"></i> Cerrar sesión
					</a>
					<a href="/admin" class="btn btn-info home-login">
						<i class="fa fa-user"></i> Administrador
					</a>
				@endif
				<a href="/" class="btn btn-primary home-login">
					<i class="fa fa-home"></i> Inicio
				</a>
			</div>
			<nav class="col-md-3">
				<h4 class="h3">Estadisticas Generales</h4>
				<ul>
					<li> <a href="/estadisticas">Productores y Tenderos</a> </li>
					<li> <a href="/estadisticas/compra-de-tenderos">Compras de Tenderos</a> </li>
					<li> <a href="/estadisticas/compra-de-productos">Compra de Productos</a> </li>
					<li> <a href="/estadisticas/promedio-de-compras">Promedio de Compras</a> </li>
				</ul>
				<h4 class="h3">Detalle por Comuna</h4>
				<ul>
					<li> <a href="/estadisticas/por-comunas">Estadisticas por Comuna</a> </li>
				</ul>
			</nav>
			<div class="stat-image col-md-9">
				
				@yield('stat')
			</div>
			<div class="footer col-xs-12">
				<img src="/images/placeholders/logos/juntos_construyendo.png" class="gobernacion">
			</div>
		</div>

		<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->

		{!! Html::script('assets/js/vendor/jquery-2.1.3.min.js') !!}
		<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
		{!! Html::script('//code.jquery.com/ui/1.11.4/jquery-ui.js') !!}

		{!! Html::script('assets/js/vendor/bootstrap.min.js') !!}
		{!! Html::script('assets/js/app.min.js') !!}
		{!! Html::script('assets/js/plugins.js') !!}
		{!! Html::script('assets/js/plugins/flot.tooltip/jquery.flot.tooltip.min.js') !!}
		{!! Html::script('assets/js/plugins/flot.tooltip/jquery.flot.tooltip.source.js') !!}
		
		<!-- Load and execute javascript code used only in this page -->
		{!! Html::script('assets/js/pages/compCharts.js') !!}
	  	@yield('js-stat')
	</body>
</html>