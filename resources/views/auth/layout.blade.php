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
    {{-- Login Container --}}

    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-6 col-md-offset-3">
            {{-- Header --}}
            <h1 class="h2 text-light text-center push-top-bottom animation-slideDown" style="margin-top: 20px;">
                @yield('title_auth')
            </h1>

            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="/images/placeholders/logos/juntos_construyendo.png" style="width:100%;">
                </div>
            </div>

            {{-- END Header --}}
        </div>
    </div>

    <div id="login-container">
        {{-- Block --}}
        <div class="block animation-fadeInQuickInv">
            {{-- Title --}}
            <div class="block-title">
                <div class="block-options pull-right">
                	@yield('buttons_header')
                </div>
                @yield('title_header')
            </div>
            {{-- END Title --}}

            {{-- Form --}}
            @yield('form_auth')
            {{-- END Form --}}
        </div>
        {{-- END Block --}}

        @yield('aditional_form')

        {{-- Footer --}}
        @include('alerts')
        <footer style="color:white; margin-top:15px;" class="text-center animation-pullUp col-md-12">
            <small>
                <span id="year-copy"></span> &copy; 
                <a href="{{ env('APP_DEVELOPER_WEBSITE') }}" style="color:white;" target="_blank">{{ env('APP_DEVELOPER') }}</a>
            </small>
        </footer>
        {{-- END Footer --}}
    </div>
    {{-- END Login Container --}}
@endsection

