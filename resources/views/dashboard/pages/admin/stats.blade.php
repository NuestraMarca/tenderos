@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-parents"></i> Estadisticas @endsection

@section('breadcrumbs') {!! Breadcrumbs::render('users') !!} @endsection

@section('content_body_page')

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <!-- Bars Chart Block -->
            <div class="block full">
                <!-- Bars Chart Title -->
                <div class="block-title">
                    <h2>Productores y Tenderos por Comunas => TOTAL {{ $shopkeepers->count() }}</h2>
                </div>
                <!-- END Bars Chart Title -->

                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars" style="height: 480px;" data-url-json="/admin/stats/commune"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <!-- Bars Chart Block -->
            <div class="block full">
                <!-- Bars Chart Title -->
                <div class="block-title">
                    <h2>Número de tenderos que Compran por Comunas => Unidad # Tenderos</h2>
                </div>
                <!-- END Bars Chart Title -->

                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars4" style="height: 580px;" data-url-json="/admin/stats/commune/shopping/count"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <!-- Bars Chart Block -->
            <div class="block full">
                <!-- Bars Chart Title -->
                <div class="block-title">
                    <h2>Total Compra de Prodcutos por Comunas => Unidad KG</h2>
                </div>
                <!-- END Bars Chart Title -->

                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars2" style="height: 580px;" data-url-json="/admin/stats/commune/shopping"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <!-- Bars Chart Block -->
            <div class="block full">
                <!-- Bars Chart Title -->
                <div class="block-title">
                    <h2>Promedio Compra de Prodcutos por Comunas => Unidad KG</h2>
                </div>
                <!-- END Bars Chart Title -->

                <!-- Bars Chart Content -->
                <!-- Flot Charts (initialized in js/pages/compCharts.js), for more examples you can check out http://www.flotcharts.org/ -->
                <div id="chart-bars3" style="height: 580px;" data-url-json="/admin/stats/commune/shopping/avg"></div>
                <!-- END Bars Chart Content -->
            </div>
            <!-- END Bars Chart Block -->
        </div>
    </div>

@endsection

@section('js_aditional')
    <!-- Load and execute javascript code used only in this page -->
    <script src="/assets/js/pages/compCharts.js"></script>
    <script>$(function(){ CompCharts.init(); });</script>
@endsection






