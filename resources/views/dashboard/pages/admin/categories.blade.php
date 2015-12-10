@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-folder_plus"></i> Categorias @stop

@section('breadcrumbs') {!! Breadcrumbs::render('categories') !!} @stop

@section('content_body_page')
	<div class="block full">
		<div class="block-title">
			<h2>Crear nueva Categoría</h2>
		</div>
		{!! Form::model($category, $form_data + ['class' => 'form-inline']) !!}
			<div class="form-group">
				<label class="sr-only" for="example-if-email">Nombre</label>
				<input type="text" id="category_name" name="name" class="form-control" placeholder="Nombre de la Categoría" style="min-width: 300px;">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
			</div>
		{!! Form::close() !!}
	</div>

	<div class="row">
		@foreach($categories as $category)
		    <div class="col-lg-3">
		        <a href="{{ route('admin.categories.products.index', $category->id) }}" class="widget text-center">
					<div class="widget-content">
						<i class="gi fa-3x gi-folder_plus text-dark"></i>
					</div>
					<div class="widget-content themed-background-muted text-dark">
						<strong class="h4">{{ $category->name }}</strong>
					</div>
				</a>
		    </div>
	    @endforeach
    </div>
    {!! $categories->render() !!}
@stop