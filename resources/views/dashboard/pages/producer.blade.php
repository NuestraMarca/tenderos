@extends('dashboard.pages.home')

@section('tabs')
    <li class="active"><a href="#shoppings">Mi Producción</a></li>
	<li><a href="#shopkeepers">Buscar Tenderos</a></li>
@endsection

@section('content_tabs')
	<!-- Producers -->
    <div class="tab-pane" id="shopkeepers">
        <div class="block-content-full">
        	
            @include('dashboard.pages.search.shopkeeper')         

            @include('dashboard.pages.search.shopkeeper-found')            

            @include('dashboard.pages.modals.producer')

        </div>
    </div>
    <!-- END Producers -->

    <!-- Shopping -->
    @include('dashboard.pages.forms.producer-shopping')
    <!-- END Shopping -->   
@endsection

@section('user_type') Productor @endsection

@section('js_home_aditional')
    
    {!! Html::script('/assets/js/services/AppProducer.js') !!}
    <script> AppProducer.init() </script>
    
@endsection