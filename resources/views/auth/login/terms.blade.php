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

            <p style="max-height:220px;overflow:auto;">En un lugar de la Mancha, de cuyo nombre no quiero acordarme, no ha mucho tiempo que 
                vivía un hidalgo de los de lanza en astillero, adarga antigua, rocín flaco y galgo corredor. 
                Una olla de algo más vaca que carnero, salpicón las más noches, duelos y quebrantos 
                los sábados, lantejas los viernes, algún palomino de añadidura los domingos, consumían 
                las tres partes de su hacienda. El resto della concluían sayo de velarte, calzas de 
                velludo para las fiestas, con sus pantuflos de lo mesmo, y los días de entresemana se 
                honraba con su vellorí de lo más fino. Tenía en su casa una ama que pasaba de los cuarenta, 
                y una sobrina que no llegaba a los veinte, y un mozo de campo y plaza, que así ensillaba 
                el rocín como tomaba la podadera. Frisaba la edad de nuestro hidalgo con los cincuenta años; 
                era de complexión recia, seco de carnes, enjuto de rostro, gran madrugador y amigo de la caza. 
                Quieren decir que tenía el sobrenombre de Quijada, o Quesada, que en esto hay alguna 
                diferencia en los autores que deste caso escriben; aunque, por conjeturas verosímiles, 
                se deja entender que se llamaba Quejana. Pero esto importa poco a nuestro cuento; basta 
                que en la narración dél no se salga un punto de la verdad.</p>


            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-effect-ripple btn-primary"><i class="fa fa-check"></i> Si, Acepto</button>
                    <a href="/auth/logout" class="btn btn-effect-ripple btn-danger"><i class="gi gi-remove_2"></i> No</a>
                </div>
            </div>
        {!! Form::close() !!}
    @endsection

