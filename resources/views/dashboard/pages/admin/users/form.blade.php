@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') gi gi-cart_in @endsection
@section('title_page') 
  <i class="gi gi-parents"></i> Editar {{ $user->type_name }} 
@endsection

@section('breadcrumbs') {!! Breadcrumbs::render('users.user', $user) !!} @endsection

@section('title_form') Formulario @endsection

@section('form')
  	
  {!! Form::model($user, $form_data) !!}

    {!! Field::text('name', ['ph' => 'Nombre']) !!}

    {!! Field::text('username', null, ['ph' => 'Usuario..']) !!}

    {!! Field::password('password', ['ph' => 'Contraseña..']) !!}

    {!! Field::password('password_confirmation', ['ph' => 'Confirmar Contraseña..']) !!}

    {!! Field::number('doc', null, ['ph' => 'Número de Cédula']) !!}

    {!! Field::text('name', null, ['ph' => 'Nombre..']) !!}

    {!! Field::email('email', null, ['ph' => 'Correo Electronico..']) !!}

    {!! Field::text('tel', null, ['ph' => 'Télefono']) !!}

    {!! Field::select('municipality_id', $municipalities, ['data-placeholder' => 'Seleccione un municipio..', 'class' => 'select-chosen']) !!}

    {!! Field::select('commune', $communes, ['data-placeholder' => 'Seleccione una comuna..', 'class' => 'select-chosen']) !!}

    {!! Field::text('address', null, ['ph' => 'Dirección']) !!}

    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Actualizar</button>
        </div>
    </div>
  {!! Form::close() !!}

@endsection

@section('js_aditional')
  
@endsection