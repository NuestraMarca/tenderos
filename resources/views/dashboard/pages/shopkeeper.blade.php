@extends('dashboard.pages.home')

@section('tabs')
	<li class="active"><a href="#shoppings">Mis Compras</a></li>
	<li><a href="#producers">Buscar Productores</a></li>
@endsection

@section('content_tabs')
	<!-- Producers -->
    <div class="tab-pane" id="producers">
        <div class="block-content-full">
        	@include('dashboard.pages.search.producer')

			@include('dashboard.pages.search.producer-found')        	

			@include('dashboard.pages.modals.shopkeeper')
        </div>
    </div>
    <!-- END Producers -->

    <!-- Shopping -->
    @include('dashboard.pages.forms.shopkeeper-shopping')
    <!-- END Shopping -->   
@endsection

@section('user_type') Tendero @endsection

@section('js_home_aditional')
    
    {!! Html::script('/assets/js/services/AppShopkeeper.js') !!}
    <script> AppShopkeeper.init() </script>

@endsection