@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-parents"></i> Tenderos @stop

@section('breadcrumbs') {!! Breadcrumbs::render('admin.shopkeepers') !!} @stop

@section('content_body_page')

	@include('dashboard.pages.search.producer')

	@include('dashboard.pages.search.producer-found')        	

	@include('dashboard.pages.modals.shopkeeper')

@endsection

@section('js_aditional')
    
    <!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps -->
    <script src="//maps.google.com/maps/api/js?sensor=true"></script>
    <script src="/assets/js/plugins/gmaps.min.js"></script>
    
    {!! Html::script('/assets/js/services/AppShopkeeper.js') !!}
    <script> 
    	AppShopkeeper.init();
    </script>

@endsection

