<div class="tab-pane active" id="shoppings">
    	<div class="row">
            <div id="formProduct" class="form-horizontal col-md-5 animation-fadeInQuick2" data-token="{{ csrf_token() }}" data-lat="{{ $user->lat }}" data-lat="{{ $user->lng }}"  data-user-id="{{ $user->id }}">
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