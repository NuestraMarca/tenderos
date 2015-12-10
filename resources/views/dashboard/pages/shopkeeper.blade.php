@extends('dashboard.pages.home')

@section('tabs')
	<li class="active"><a href="#shoppings">Mis Compras</a></li>
	<li><a href="#producers">Buscar Productores</a></li>
@endsection

@section('content_tabs')
	<!-- Producers -->
    <div class="tab-pane" id="producers">
        <div class="block-content-full">
        	<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="header-section">
						{!! Form::open() !!}
							<div class="form-group">
								<input name="product_id" id="product-search" style="width:100%;"></input>
							</div>
							<div class="form-group">
								{!! Form::select('subregion', [''] + $subregions, null, ['class' => 'select-chosen', 'data-placeholder' => 'Seleccione Regiones de cosecha', 'id' => 'subregion']) !!}
							</div>
							<div class="form-group">
								{!! Form::select('months[]', $months, null, ['class' => 'select-chosen', 'data-placeholder' => 'Seleccione Meses del cosecha', 'multiple', 'id' => 'months']) !!}
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-effect-ripple btn-effect-ripple btn-primary">Buscar Productores</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>

        	<div id="producers_found" class="row themed-background-muted" style="max-height: 512px; overflow: scroll; padding-top:20px;">
				@foreach($producers as $producer)
					<div class="col-sm-6 col-md-4">
						<a href="#modal-fade" data-producer="{{ $producer }}" data-toggle="modal" class="widget">
							<div class="widget-content text-right clearfix">
								<img src="/images/placeholders/avatars/avatar9.jpg" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
								<h3 class="widget-heading h4"><strong>{{ $producer->name }}</strong></h3>
								<span class="text-muted"><i class="gi gi-iphone_shake"></i> {{ $producer->tel }}</span>
							</div>
						</a>
					</div>
				@endforeach
			</div>

			<div id="modal-fade" class="modal fade" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 class="modal-title"><strong id="modal-producer-name">Mr. Brennon Stamm MD</strong></h3>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-6">
									<p class="h4"><i class="fa fa-at text-primary"></i> <span id="modal-producer-email">Kailey.Gorczany@Haag.com</span></p>
									<p class="h4"><i class="gi gi-iphone_shake text-danger"></i> <span id="modal-producer-tel">3142308171</span></p>
									<p class="h4"><i class="gi gi-home text-primary"></i> <span id="modal-producer-address">Carrera 38 # 23 - 68 San Benito</span></p>
									<p class="h4"><i class="fa fa-map-marker text-danger"></i> <span id="modal-producer-municipality">Villavicencio</span></p>

						            <div class="block">
						                <div class="block-title">
						                    <h2><i class="fa fa-map-marker"></i> Ubicación</h2>
						                </div>
						               	<div class="block-content-full">
						                    <div id="gmap-markers" class="gmap" style="height: 260px;"></div>
						                </div>
						            </div>										
								</div>
								<div class="col-sm-6">
									<p class="h3 sub-header">Productos</p>
									<table class="table table-striped table-borderless table-hover table-vcenter">
										<tbody id="modal-producer-productions">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>

        </div>
    </div>
    <!-- END Producers -->

    <!-- Shopping -->
    <div class="tab-pane active" id="shoppings">
    	<div class="row">
            <div id="formProduct" class="form-horizontal col-md-5 animation-fadeInQuick2" data-token="{{ csrf_token() }}" data-lat="{{ $user->lat }}" data-lat="{{ $user->lng }}">
				<h1 class="h4">Agrega tus Compras</h1>
				<hr>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="example-hf-email">Producto</label>
					<div class="col-xs-9">
						<a href="#" id="product" class="productEditable newProduct editable editable-click editable-empty" data-name="product"></a>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="example-hf-email">Cantidad</label>
					<div class="col-xs-9">
						<a href="#" id="amount" class="amountEditable newProduct editable editable-click editable-empty" data-name="amount" data-original-title="Escriba la Cantidad"></a>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="example-hf-email">Unidad</label>
					<div class="col-xs-9">
						<a href="#" id="unit" class="unitEditable newProduct editable editable-click editable-empty" data-name="unit"></a>
					</div>
				</div>
				<div class="form-group form-actions">
					<div class="col-xs-9 col-xs-offset-3">
						<button type="submit" id="save-btn" class="btn btn-effect-ripple btn-primary"> 
							<i class="fa fa-plus"></i> Agregar
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<h1 class="h4">Mis Compras Agregadas</h1>
				<hr>
				<table id="users" class="table table-vcenter table-hover table-bordered">
			        <tr class="animation-fadeInQuick2">
			        	<th>Producto</th>
			        	<th class="text-center">Cantidad</th>
			        	<th class="text-center">Unidad</th>
			        	<th class="text-center"><i class="gi gi-fire"></i></th>
			        </tr>
			        
	                @foreach($user->shoppingInterests as $count => $product)
		                <tr class="animation-fadeInQuick2" id="{{ $product->pivot->id }}" >
				            <td><a href="#" class="productEditable editable editable-click" data-value="{{ $product->id }}" data-pk="{{ $product->pivot->id }}">{{ $product->name }}</a></td>
				            <td class="text-center"><a href="#" class="amountEditable editable editable-click" data-pk="{{ $product->pivot->id }}">{{ $product->pivot->amount }}</a></td>
				            <td class="text-center"><a href="#" class="unitEditable editable editable-click" data-value="{{ $product->pivot->id }}" data-pk="{{ $product->pivot->id }}">{{ $product->pivot->unit }}</a></td>
				        	<td class="text-center text-danger"><a href="#" class="text-danger" title="Borrar" data-product-id="{{ $product->pivot->id }}" onclick="AppShopkeeper.postDeleteProduct(this)"><i class="gi gi-bin"></i></a></td>
				        </tr> 
		            @endforeach
	            </table>
            </div>
		</div>
    </div>
    <!-- END Shopping -->   
@endsection

@section('user_type') Tendero @endsection

@section('js_home_aditional')
    
    {!! Html::script('/assets/js/services/AppShopkeeper.js') !!}
    <script> AppShopkeeper.init() </script>

@endsection