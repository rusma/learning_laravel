@layout('master')

@section('container')
	<p>Here is your shortened url:</p>
	{{ HTML::link($shortened, "laravel.dev/$shortened") }}

	@if(isset($error) )
		{{$error}}
	@endif
@endsection