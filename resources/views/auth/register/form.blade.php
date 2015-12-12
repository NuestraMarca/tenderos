@extends ('layout')

@section ('title_page') .: {{ env('APP_NAME') }} | Login :. @endsection

@section ('css_files') 
    @include('auth.css')
@endsection

@section ('meta') 
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
@endsection

@section ('class_body') class="auth" @endsection

@section ('content_body')
    <!-- Login Container -->
    <div id="login-container">
        <!-- Register Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-plus"></i> <strong>@yield('register_title')</strong>
        </h1>
        <!-- END Register Header -->

        <!-- Register Form -->
        <div class="block animation-fadeInQuickInv">
            <!-- Register Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="/auth/login" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Volver atrás"><i class="fa fa-user"></i></a>
                </div>
                <h2>Formulario de Registro</h2>
            </div>
            <!-- END Register Title -->

            {!! Form::open(array('url' => 'auth/register', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-login')) !!}

                {!! Field::text('username', null, ['placeholder' => 'Usuario..', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::password('password', ['placeholder' => 'Contraseña..', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::password('password_confirmation', ['placeholder' => 'Confirmar Contraseña..', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::number('doc', null, ['placeholder' => 'Número de Cédula', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::text('name', null, ['placeholder' => 'Nombre..', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::email('email', null, ['placeholder' => 'Correo Electronico..', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::text('tel', null, ['placeholder' => 'Télefono', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::text('address', null, ['placeholder' => 'Dirección', 'template' => 'themes.bootstrap.fields.empty']) !!}

                {!! Field::select('municipality_id', $municipalities, ['data-placeholder' => 'Seleccione un municipio..', 'template' => 'themes.bootstrap.fields.empty', 'class' => 'select-chosen']) !!}

                @yield('inputs_extra')

                <div class="form-group form-actions">
                    <div class="col-xs-6">
                        <label class="csscheckbox csscheckbox-primary" data-toggle="tooltip" title="Acepto los terminos y condiciones">
                            <input type="checkbox" id="register-terms" name="terms" required value="1">
                            <span></span>
                        </label>
                        <a href="#modal-terms" data-toggle="modal"> Terminos</a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-effect-ripple btn-primary"><i class="fa fa-plus"></i> Si, Registrarme</button>
                    </div>
                </div>
            {!! Form::close() !!}

            <!-- END Register Form -->
        </div>
        <!-- END Register Block -->
    </div>
    <!-- END Login Container -->

    @include('auth.register.terms')
@endsection

@section('js_files')
    @include('auth.register.js')
@endsection
