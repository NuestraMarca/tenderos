@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') gi gi-cart_in @endsection
@section('title_page') 
  <i class="gi gi-parents"></i> Editar {{ $producer->type_name }} 
@endsection

@section('breadcrumbs') {!! Breadcrumbs::render('admin.producers.user', $producer) !!} @endsection

@section('title_form') Formulario de Productor @endsection

@section('form')
  	
  {!! Form::model($producer, $form_data) !!}

    @include('dashboard.pages.admin.user-inputs')

  {!! Form::close() !!}

@endsection

@section('js_aditional')
  
@endsection