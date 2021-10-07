@extends("template/web")

@section("titulo", "Cadastro de Espécies")

@section("formulario")
	<h3>Cadastro de Espécies</h3>
	<form method="POST" action="/especie" class="row">
		
		@csrf
		<input type="hidden" name="id" value="{{ $especie->id }}" />
	
		<div class="form-group col-8">
			<label for="nome">Nome: </label>
			<input type="text" name="nome" class="form-control" value="{{ $especie->nome }}" required />
		</div>
		<div class="form-group col-4">
			<a href="/especie" class="btn btn-primary bottom">
				<i class="fas fa-plus"></i>
				Novo
			</a>
			<button type="submit" class="btn btn-success bottom">
				<i class="fas fa-save"></i>
				Salvar
			</button>
		</div>
	</form>
@endsection	

@section("tabela")
	<h3>Listagem de Espécies</h3>
	<table class="table table-striped">
		<colgroup>
			<col width="200">
			<col width="80">
			<col width="80">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($especies as $especie)
				<tr>
					<td>{{ $especie->nome }}</td>
					<td>
						<a href="/especie/{{ $especie->id }}/edit" class="btn btn-warning">
							<i class="fas fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/especie/{{ $especie->id }}">
							<input type="hidden" name="_method" value="DELETE" />
							@csrf
							<button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?');">
								<i class="fas fa-trash"></i>
								Excluir
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection