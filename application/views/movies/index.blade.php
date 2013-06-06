<html>
<head>
	<title>Movie</title>
</head>
	<body>
		<p>{{ HTML::link_to_route('new_movie', 'Çreate a new movie') }}</p>
		<p>{{ HTML::link_to_route('movie', 'Show movie', array(1)) }}</p>
	</body>
</html>