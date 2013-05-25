@layout('master')

@section('container')
	<h2>Submit this form</h2>
	
	{{ Form::open() }}
		{{ Form::label('name', 'Your Name') }}
		{{ Form::text('name') }}

		<div>{{ Form::submit('submit the form') }}</div>
	{{ Form::close() }}
	
@endsection