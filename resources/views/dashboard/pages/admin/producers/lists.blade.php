@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-parents"></i> Usuarios @stop

@section('breadcrumbs') {!! Breadcrumbs::render('admin.producers') !!} @stop

@section('content_body_page')
	
	@include('dashboard.pages.search.shopkeeper')

	@include('dashboard.pages.search.shopkeeper-found')        	

	@include('dashboard.pages.modals.producer')

@endsection

@section('js_aditional')
    
    <!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps -->
    <script src="//maps.google.com/maps/api/js?sensor=true"></script>
    <script src="/assets/js/plugins/gmaps.min.js"></script>
    
    {!! Html::script('/assets/js/services/AppProducer.js') !!}
    <script> AppProducer.init() </script>
    
@endsection





