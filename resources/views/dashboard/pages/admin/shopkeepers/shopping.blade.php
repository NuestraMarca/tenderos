@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-parents"></i> Intereses de Compra: {{ $user->name }} @stop

@section('breadcrumbs') {!! Breadcrumbs::render('admin.shopkeepers.user', $user) !!} @stop

@section('content_body_page')
	<div class="block full">
		<div class="block-title">
			<h2>Formulario</h2>
		</div>
		<!-- Shopping -->
	    @include('dashboard.pages.forms.shopkeeper-shopping')
    <!-- END Shopping --> 
    </div>

@endsection

@section('js_aditional')
    
    {!! Html::script('/assets/js/services/AppShopkeeper.js') !!}
    <script> 
    	AppShopkeeper.init();
    </script>

@endsection

