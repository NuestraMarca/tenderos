@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-parents"></i> Producción de {{ $user->name }} @stop

@section('breadcrumbs') {!! Breadcrumbs::render('admin.shopkeepers.user', $user) !!} @stop

@section('content_body_page')
	<div class="block full">
		<div class="block-title">
			<h2>Formulario</h2>
		</div>
		<!-- Shopping -->
	    @include('dashboard.pages.forms.producer-shopping')
	    <!-- END Shopping --> 
	</div>

@endsection

@section('js_aditional')
    
    {!! Html::script('/assets/js/services/AppProducer.js') !!}
    <script> 
    	AppProducer.init();
    </script>

@endsection

