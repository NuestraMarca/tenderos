@extends ('auth.layout')
    @section('title_auth')
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-cube"></i> <strong> {{ env('APP_NAME') }} </strong>
        </h1>
    @endsection
    @section('buttons_header')
        <a href="/" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Olvidaste tu contraseña?"><i class="fa fa-exclamation-circle"></i></a>
    @endsection
    @section('title_header')
        <h2>Terminos y condiciones</h2>
    @endsection
    @section('form_auth')
        {!! Form::open(array('url' => 'auth/terms', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form-login')) !!}

            <p style="max-height:220px;overflow:auto;">
                <h4 class="page-header">1. <strong>Registro y Contraseña</strong></h4>
                <p>El titular se reserva el derecho de solicitar la registración del Visitante para la
                red de tenderos, toda o parte de ella, que previamente haya sido de libre acceso y, en
                tal caso, está facultada, en cualquier momento y sin expresión de causa, a
                denegar al usuario el acceso al área protegida por contraseñas, en particular si el
                usuario:
                </p>
                <ul>
                    <li>Proporciona datos incorrectos con el fin de registrarse</li>
                    <li>Incumple estos Términos y Condiciones de Uso y Privacidad</li>
                    <li>Incumple cualquier normativa aplicable respecto del acceso o el uso del presente sistema web</li>
                </ul>
            </p>


            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-primary"><i class="fa fa-check"></i> Si, Acepto</button>
                    <a href="/auth/logout" class="btn btn-effect-ripple btn-danger"><i class="gi gi-remove_2"></i> No</a>
                </div>
            </div>
        {!! Form::close() !!}
    @endsection

