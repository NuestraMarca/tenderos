@extends('dashboard.pages.layout')

@section('title_page') <i class="fa fa-user"></i> Administrador de la Red de Tenderos @stop

@section('breadcrumbs') {!! Breadcrumbs::render('categories') !!} @stop

@section('content_body_page')
	<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="/estadisticas" class="widget text-center">
			<div class="widget-content">
				<img src="/images/placeholders/icons/stats.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
			</div>
			<div class="widget-content themed-background-muted text-dark">
				<strong class="h3">Estadísticas</strong>
			</div>
		</a>
    </div>

	<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="/admin/categories" class="widget text-center">
			<div class="widget-content">
				<img src="/images/placeholders/icons/box.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
			</div>
			<div class="widget-content themed-background-muted text-dark">
				<strong class="h3">Categorías</strong>
			</div>
		</a>
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="/admin/tenderos" class="widget text-center">
			<div class="widget-content">
				<img src="/images/placeholders/icons/Shop-512.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
			</div>
			<div class="widget-content themed-background-muted text-dark">
				<strong class="h3">Tenderos</strong>
			</div>
		</a>
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
        <a href="/admin/productores" class="widget text-center">
			<div class="widget-content">
				<img src="/images/placeholders/icons/Farmer-2-512.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
			</div>
			<div class="widget-content themed-background-muted text-dark">
				<strong class="h3">Productores</strong>
			</div>
		</a>
    </div>
@stop




