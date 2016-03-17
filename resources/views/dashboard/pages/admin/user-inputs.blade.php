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