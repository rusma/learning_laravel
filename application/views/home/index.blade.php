@layout('master')

@section('content')
	@foreach ($users as $user)
		{{ $user->email }}
	@endforeach
@endsection