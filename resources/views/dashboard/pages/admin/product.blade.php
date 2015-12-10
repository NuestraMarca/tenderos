@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') gi gi-cart_in @endsection
@section('title_page') 
  <i class="gi gi-cart_in"></i> Editar Producto 
@endsection

@section('breadcrumbs') {!! Breadcrumbs::render('categories.category.product', $category, $product) !!} @endsection

@section('title_form') Datos del Producto @endsection

@section('form')
  {!! Form::model($product, $form_data) !!}

    {!! Field::text('name', ['class' => 'form-control', 'ph' => 'Nombre del Producto']) !!}

    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Actualizar</button>
        </div>
    </div>
  {!! Form::close() !!}
@endsection

@section('js_aditional')
  
@endsection