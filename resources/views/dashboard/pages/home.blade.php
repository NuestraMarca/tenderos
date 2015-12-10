@extends('dashboard.layout')
@section('meta_extra') 
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <meta name="auth-user" content="{{ Auth::user() }}" /> 
@endsection
@section('class_page_content') inner-sidebar-right @endsection
@section('content_page')
    <!-- Inner Sidebar -->
    <div id="page-content-sidebar">
        <!-- Collapsible People List -->
        <a href="javascript:void(0)" class="btn btn-block btn-effect-ripple btn-primary visible-xs" data-toggle="collapse" data-target="#people-nav">Chat Comunal</a>
        <div id="people-nav" class="collapse navbar-collapse remove-padding">
            <div class="block-section">
                <h4 class="inner-sidebar-header">
                    Chat Comunal
                </h4>
                <ul class="nav-users nav-users-online">
                    @foreach($sessions as $session)
                        <li id="li-chat-user-{{ $session->user->id }}">
                            <a href="javascript:void(0)" id="chat-user-{{ $session->user->id }}" class="chat-user" data-user='{{ $session->user }}' data-user-messages="{{ $session->user->getAllMessages() }}">
                                <img src="{{ $session->user->image }}" alt="image" class="nav-users-avatar">
                                <span class="label label-success nav-users-indicator"></span>
                                <span class="nav-users-heading">{{ $session->user->name }}</span>
                                <span class="text-muted">{{ $session->user->type_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if(!$offlineUsers->isEmpty())
                <div class="block-section">
                    <h4 class="inner-sidebar-header">
                        Desconectados
                    </h4>
                    <ul class="nav-users nav-users-offline">
                        @foreach($offlineUsers as $user)
                            <li id="li-chat-user-{{ $user->id }}">
                                <a href="javascript:void(0)" id="chat-user-{{ $user->id }}" class="chat-user" data-user='{{ $user }}' data-user-messages="{{ $user->getAllMessages() }}">
                                    <img src="{{ $user->image }}" alt="image" class="nav-users-avatar">
                                    <span class="label label-success nav-users-indicator"></span>
                                    <span class="nav-users-heading">{{ $user->name }}</span>
                                    <span class="text-muted">{{ $user->type_name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <!-- END Collapsible People List -->
    </div>
    <!-- END Inner Sidebar -->

    <!-- Social Net Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
    <div class="content-header content-header-media" style="height:120px; margin-bottom:0;">
        <div class="header-section">
            <div class="row">
                <div class="col-sm-7 col-md-8 col-lg-9 content-float-hor push-bit-top-bottom clearfix">
                    <img src="images/placeholders/avatars/avatar14.jpg" alt="User Image" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                    <h1>{{ Auth::user()->name }}</h1>
                    <h2 class="text-light-op"> Soy @yield('user_type') </h2>
                </div>
                <div class="col-sm-5 col-md-4 col-lg-3 text-right push-bit-top-bottom">

                </div>
            </div>
        </div>
        <!-- For best results use an image with a resolution of 2560x260 pixels (you could use a blurred image for smaller file size) -->
        <img src="images/placeholders/photos/cielo.jpg" alt="Header Image" class="animation-pulseSlow">
    </div>
    <!-- END Social Net Header -->

    <!-- Chat Widget -->
    <!-- You can remove .chatui-window & .chatui-window-close class for a static chat widget -->
    <div class="widget chatui chatui-window chatui-window-close remove-radius-bottom" data-receptor-id="">
        <div class="widget-content widget-content-mini themed-background">
            <a href="javascript:void(0)" class="chatui-action-open text-dark-op pull-right"><i class="fa fa-arrow-up"></i></a>
            <a href="javascript:void(0)" class="chatui-action-close text-dark-op pull-right"><i class="fa fa-times"></i></a>
            <a href="javascript:void(0)" class="text-light chatui-action-open"><strong class="chat-user-name">Chat Comunal</strong></a>
            <a href="javascript:void(0)" class="text-light chatui-action-close"><strong class="chat-user-name">Chat Comunal</strong></a>
        </div>
        <div class="widget-content widget-content-mini chatui-talk">
            <ul id="chat-content">
                
            </ul>
        </div>
        <div class="widget-content widget-content-full chatui-form remove-radius-bottom">
            <form action="page_app_social.html" method="post" class="remove-margin">
                <input type="text" id="chat-message" name="chat-message" class="form-control" placeholder="Escriba su mensaje..">
            </form>
        </div>
    </div>
    <!-- END Chat Widget -->

    <!-- Social Net Content -->
    <div class="row">
        <div class="block full">
            <!-- Block Tabs Title -->
            <div class="block-title">
                <ul class="nav nav-tabs" data-toggle="tabs">
                    @yield('tabs')
                </ul>
            </div>
            <!-- END Block Tabs Title -->

            <!-- Tabs Content -->
            <div class="tab-content">
                @yield('content_tabs')
            </div>
            <!-- END Tabs Content -->
        </div>
    </div>
    <!-- END Social Net Content -->
@endsection

@section('js_aditional')
    <!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps -->
    <script src="//maps.google.com/maps/api/js?sensor=true"></script>
    <script src="/assets/js/plugins/gmaps.min.js"></script>
    
    @yield('js_home_aditional')

    <!-- Load and execute javascript code used only in this page -->
    {!! Html::script('/assets/js/pages/appSocial.js') !!}
    <script>$(function(){ AppSocial.init(); });</script>

    <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>

    <script>
        // Ensure CSRF token is sent with AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /***********************************************/

        var pusher = new Pusher('{{env("PUSHER_KEY")}}');

        var channel = pusher.subscribe('{{$chatChannel}}');
        channel.bind('new-message', AppSocial.addMessage);

        var channelNotofications = pusher.subscribe('notifications');
        channelNotofications.bind('new-login', AppSocial.newLogin);
        channelNotofications.bind('new-logout', AppSocial.newLogout);

    </script>
    
@endsection
