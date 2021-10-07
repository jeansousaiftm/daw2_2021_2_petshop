<html>
	<head>
		<title>@yield("titulo")</title>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/all.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
		<script src="{{ asset('js/jquery.js') }}"></script>
	</head>
	<body>
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link active" href="/especie">Espécies</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="/animal">Animais</a>
			</li>
		</ul>
		
		@if (Session::get("status") == "salvo")
			<div class="alert alert-success" role="alert">
				Salvo com sucesso!
			</div>
		@endif
		
		@if (Session::get("status") == "excluido")
			<div class="alert alert-danger" role="alert">
				Excluído com sucesso!
			</div>
		@endif
		
		<div class="container">
			@yield("formulario")
			@yield("tabela")
		</div>
	</body>
</html>