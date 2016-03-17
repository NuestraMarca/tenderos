<html>
<head>
	<title>Proyecto juntos con el tendero</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/plugins.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/themes.css">

	<link rel="stylesheet" type="text/css" href="/assets/css/landing.css">
</head>
<body>
	<div class="main">
		<h1><a href="/" title="Volver al inicio" class="text-info">Proyecto juntos con el tendero</a></h1>
		<div class="video-youtube">
			<iframe width="100%" height="340" src="https://www.youtube.com/embed/_MIYIWF1_cE" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="login-sistema">
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

			</div>
			
			<h2>Ingrese a la red de tenderos</h2>
			
			<div class="file-icons">
				<figure>
					<a href="/images/files/LOCALIZACION-COORDENADAS.pdf">
						<img src="/images/placeholders/icons/map2.png">
						<figcaption itemprop="caption description">Mapaeo</figcaption>   
					</a>                               
				</figure> 
				<figure>
					<a href="/images/files/INFORME-DE-ACTIVIDADES-TENDEROS-F.pdf">
						<img src="/images/placeholders/icons/print.png">
						<figcaption itemprop="caption description">Resultados</figcaption> 
					</a>                                 
				</figure> 
				<figure>
					<a href="/estadisticas">
						<img src="/images/placeholders/icons/stats.png">
						<figcaption itemprop="caption description">Estadísticas</figcaption>                                  
					</a>
				</figure> 
				@if(Auth::check() && Auth::user()->isAdmin())
					<figure>
						<a href="/images/files/MATRIZ-ENCUESTAS-TENDEROS-2.xls">
							<img src="/images/placeholders/icons/pc.png">
							<figcaption itemprop="caption description">Base de Datos</figcaption>                                  
						</a>
					</figure> 
				@endif
				
			</div>
		</div>
		<div class="files">
			
		</div>
		<div class="footer">
			<img src="/images/placeholders/logos/juntos_construyendo.png" class="gobernacion">
		</div>
	</div>
</body>
</html>