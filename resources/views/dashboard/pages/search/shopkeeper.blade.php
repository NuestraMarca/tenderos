<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="header-section">
            {!! Form::open() !!}
                <div class="form-group">
                    <input name="product_id" id="product-search" style="width:100%;"></input>
                </div>
                <div class="form-group">
                    {!! Form::select('communes[]', $communes, null, ['class' => 'select-chosen', 'data-placeholder' => 'Comunas', 'id' => 'communes', 'multiple']) !!}
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-effect-ripple btn-effect-ripple btn-primary">Buscar Tenderos</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>