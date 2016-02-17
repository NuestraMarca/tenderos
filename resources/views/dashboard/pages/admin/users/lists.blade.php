@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-parents"></i> Usuarios @stop

@section('breadcrumbs') {!! Breadcrumbs::render('users') !!} @stop

@section('content_body_page')

	<div class="row">
		@foreach($users as $user)
		    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
	            <a href="{{ route('admin.users.edit', $user) }}" class="widget">
	                <div class="widget-content text-right clearfix">
	                    <img src="{{ $user->image }}" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
	                    <h3 class="widget-heading h4"><strong>{{ $user->name }}</strong></h3>
	                    <span class="text-muted"><i class="gi gi-iphone_shake"></i> {{ $user->tel }}</span>
	                </div>
	            </a>
	        </div>
	    @endforeach
    </div>
    {!! $users->render() !!}
@stop



