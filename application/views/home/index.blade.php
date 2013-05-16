@layout('master')

@section('container')
{{ Form::open('/') }}
	{{ Form::label('url', 'Your long URL')}}
	{{ Form::text('url') }}
	{{ Form::submit('Shorten')}}
{{ Form::close() }}
{{ $errors->first('url', '<p class="error">:message</p>') }}
@endsection