@extends ('auth.layout')
    @section('title_auth')
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-cube"></i> <strong> {{ env('APP_NAME') }} </strong>
        </h1>
    @endsection

    @section('title_header')
        <h2>Iniciar Sesión</h2>
    @endsection
    
    @section('form_auth')
        {!! Form::open(array('url' => 'auth/login', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'form-login')) !!}

            {!! Field::text('username', null, ['placeholder' => 'Usuario..', 'template' => 'themes.bootstrap.fields.empty']) !!}

            {!! Field::password('password', ['placeholder' => 'Contraseña..', 'template' => 'themes.bootstrap.fields.empty']) !!}

            <div class="form-group form-actions">
                <div class="col-xs-8">
                    <label class="csscheckbox csscheckbox-primary">
                        <input type="checkbox" id="login-remember-me" name="remember" value="true">
                        <span></span>
                    </label>
                    Recordarme
                </div>
                <div class="col-xs-4 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-primary"><i class="fa fa-check"></i> Iniciar</button>
                </div>
            </div>
        {!! Form::close() !!}
    @endsection

    @section('aditional_form')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a href="/auth/register" class="btn btn-block btn-lg btn-warning">Quiero registrarme</a>
            </div>
        </div>
    @endsection
