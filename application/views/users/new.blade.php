@layout('master')

@section('container')
	<h1>Create new user</h1>
	{{ Form::open('/users/', 'POST') }}
		{{ Form::label('username', 'User name: ') }}
		{{ Form::text('username') }}
	{{ Form::close() }}
@endsection