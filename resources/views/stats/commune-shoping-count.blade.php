@extends('stats.layout')

@section('stat')
	<div class="row">
        <div class="col-xs-12">
            <!-- Bars Chart Block -->
            <div class="block full">
            	<h3 class="title-stat">Número de tenderos que Compran por Comunas => Unidad # Tenderos</h3>
                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars-shopkkepers-communes" style="height: 480px;" data-url-json="/stats/commune/shopping/count"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>
@endsection

@section('js-stat')
	<script>$(function(){ CompCharts.shopkeepersCommunes(); });</script>
@endsection