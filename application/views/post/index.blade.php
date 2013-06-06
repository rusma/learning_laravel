@layout('master')

@section('container')
	@foreach($posts as $post)
		<h2>{{ $post->title }}</h2>
		<p>Written by: {{ $post->author->name }}</p>
	@endforeach
@endsection
