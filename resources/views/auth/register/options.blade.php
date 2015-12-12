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
    
    <div class="row" style="margin: auto;">
    	<div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12" style="position:absolute; top:30%;">
    		<div class="col-sm-5 col-sm-offset-1 col-xs-6">
				<a href="/auth/register-shopkeeper" class="widget">
					<div class="widget-content text-center">
						<img src="/images/placeholders/icons/Shop-512.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
					</div>
					<div class="widget-content themed-background-muted text-dark text-center">
						<h1 class="h3 btn btn-lg btn-primary">Soy Tendero</h1>
					</div>
				</a>
			</div>

			<div class="col-sm-5 col-xs-6">
				<a href="/auth/register-producer" class="widget">
					<div class="widget-content text-center">
						<img src="/images/placeholders/icons/Farmer-2-512.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
					</div>
					<div class="widget-content themed-background-muted text-dark text-center">
						<h1 class="h3 btn btn-lg btn-danger">Soy Productor</h1>
					</div>
				</a>
			</div>
    	</div>
    </div>

@endsection

