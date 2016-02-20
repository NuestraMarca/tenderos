@extends('stats.layout')

@section('stat')
	<div class="row">
        <div class="col-xs-12">
            <!-- Bars Chart Block -->
            <div class="block full">
            	<h3 class="title-stat">Total Compra de Prodcutos por Comunas => Unidad KG</h3>
                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars-products-communes" style="height: 480px;" data-url-json="/stats/commune/shopping"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>
@endsection

@section('js-stat')
	<script>$(function(){ CompCharts.productsCommunes(); });</script>
@endsection