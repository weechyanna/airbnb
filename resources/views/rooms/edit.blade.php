@extends('layouts.master')

@section('master')
	@if ($errors->any())
		<div class="alert alert-danger" role="alert">
			{{ $errors->first() }}
		</div>
	@endif

	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-md-7 mx-auto">
					{!! Form::model($room, ['route' => ['rooms.update', $room->id], 'method' => 'put', 'class' => 'form']) !!}
						{!! Form::text('title', $room->title, ['class' => 'form-control']); !!}
						{!! Form::text('description', $room->description, ['class' => 'form-control']); !!}
						{!! Form::number('price', $room->price, ['class' => 'form-control']); !!}
						{!! Form::text('location', $room->location, ['class' => 'form-control']); !!}
						{!! Form::text('type', $room->type, ['class' => 'form-control']) !!}
						{!! Form::submit('Update', ['class' => 'btn btn-primary ml-auto mt-3']); !!}
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
@endsection
