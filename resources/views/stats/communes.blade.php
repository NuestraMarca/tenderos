@extends('stats.layout')

@section('stat')
	<div class="row">
        <div class="col-xs-12">
            <!-- Bars Chart Block -->
            <div class="block full">
            	<h3 class="title-stat" style="display: inline-block;">Detalle por Comunas</h3>
                <select id="communes" class="form-control" style="display: inline-block; width: 200px; margin-left: 1em;">
                  <option value="1" selected>Comuna 1</option>
                  <option value="2">Comuna 2</option>
                  <option value="3">Comuna 3</option>
                  <option value="4">Comuna 4</option>
                  <option value="5">Comuna 5</option>
                  <option value="6">Comuna 6</option>
                  <option value="7">Comuna 7</option>
                  <option value="8">Comuna 8</option>
                </select>
                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars-communes" style="height: 480px;" data-url-json="/stats/communes"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>
@endsection

@section('js-stat')
	<script>$(function(){ CompCharts.communes(); });</script>
    
    <script>
        var baseUrl = '/stats/communes?commune=';
        
        $( "select#communes" ).on('change', function() {
            $("#chart-bars-communes").data('url-json', baseUrl + this.value);
            console.log(baseUrl + this.value);
            CompCharts.communes();
        });
    </script>

@endsection