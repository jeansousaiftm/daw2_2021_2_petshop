@extends("template/web")

@section("titulo", "Cadastro de Animais")

@section("formulario")
	<h3>Cadastro de Animais</h3>
	<form method="POST" action="/animal" class="row">
		
		@csrf
		<input type="hidden" name="id" value="{{ $animal->id }}" //>
	
		<div class="form-group col-4">
			<label for="nome">Nome: </label>
			<input type="text" name="nome" class="form-control" value="{{ $animal->nome }}" required />
		</div>
		<div class="form-group col-4">
			<label for="dono">Dono: </label>
			<input type="text" name="dono" class="form-control" value="{{ $animal->dono }}" required />
		</div>
		<div class="form-group col-4">
			<label for="especie">Espécie: </label>
			<select name="especie" class="form-control" required>
				<option></option>
				@foreach ($especies as $especie)
					@if ($especie->id == $animal->especie)
						<option value="{{ $especie->id }}" selected="selected">{{ $especie->nome }}</option>
					@else
						<option value="{{ $especie->id }}">{{ $especie->nome }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="form-group col-4">
			<label for="raca">Raça: </label>
			<input type="text" name="raca" class="form-control" value="{{ $animal->raca }}" required />
		</div>
		<div class="form-group col-4">
			<label for="nascimento">Data de Nascimento: </label>
			<input type="date" name="nascimento" class="form-control" value="{{ $animal->nascimento }}" required />
		</div>
		<div class="form-group col-4">
			<a href="/animal" class="btn btn-primary bottom">
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
	<h3>Listagem de Animais</h3>
	<table class="table table-striped">
		<colgroup>
			<col width="200">
			<col width="100">
			<col width="200">
			<col width="80">
			<col width="80">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Idade</th>
				<th>Espécie</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($animais as $animal)
				<tr>
					<td>{{ $animal->nome }}</td>
					<td>{{ $animal->idade }}</td>
					<td>{{ $animal->especie }}</td>
					<td>
						<a href="/animal/{{ $animal->id }}/edit" class="btn btn-warning">
							<i class="fas fa-edit"></i>
							Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/animal/{{ $animal->id }}">
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