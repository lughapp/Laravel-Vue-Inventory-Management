@extends('layouts.master')

@section('content')
<div id="definicoes" class="content">
	<div id="elimodal" class="grid-modal align-items-center min-vh-100 justify-content-center">
		<div class="grid-modal-card">
			<h3 class="grid-modal-title text-center mb-4">Tem a certeza que deseja eliminar?</h3>
				<form id="formeliminar" action="/definicoes/c/topologias/" method="POST">
					@method('DELETE')
					@csrf
			<div class="grid-modal-footer d-flex justify-content-center">
					<button id="fechar-elimodal" class="grid-button m-1 cancel">Cancelar</button>
					<button class="grid-button m-1 bgc-red">Eliminar</button>
			</div>
				</form>
		</div>
	</div>
	<a id="fixed-search" class="fixed-icon">
		<i class="grid-search"></i>
	</a>
	<div id="searchbar">
		<form action="/definicoes/c/topologias" method="GET" role="search">
			<div class="row">
				<div class="col-md-4 offset-md-8">
					<div class="input-group">
						<input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ request()->get('nome') ?? '' }}">
					</div>
				</div>
			</div>
			<div class="submit-btn">
				<button type="submit" class="grid-btn-top"><i class="grid-search mr-1"></i> Pesquisar</button>
			</div>
		</form>
	</div>
	<div class="main">
		<div class="breadcrumb-holder d-flex">
			<div class="flex-grow-1">
				<ol class="breadcrumb pt-3">
					<li class="breadcrumb-item"><a href="{{ url('/definicoes') }}" class="ftc-blue">Definições</a></li>
					<li class="breadcrumb-item active" aria-current="page">Topologias</li>
				</ol>
			</div>
			<div class="flex-shrink-1 pt-2">
				<a class="grid-btn bgc-blue" href="{{ url('/definicoes/c/topologias/create') }}">Adicionar</a>
			</div>
	</div>
		<div class="table-responsive mt-4">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="brdc-blue" scope="col">
							<a href="{{ route('topologias.index', ['order' => 'id']) }}" class="ftc-main">
								ID
								<i class="grid-sort"></i>
							</a>
						</th>
						<th class="brdc-blue">
							<a href="{{ route('topologias.index', ['order' => 'nome']) }}" class="ftc-main">
								Nome
								<i class="grid-sort"></i>
							</a>
						</th>
						<th class="brdc-blue">
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($typologies as $typology)
					<tr>
						<th scope="row">{{ $typology->id }}</th>
						<td>{{ $typology->nome }}</td>
						<td class="d-flex justify-content-end">
							<a href="{{ url('/definicoes/c/topologias/' . $typology->id . '/edit') }}">
								<i class="grid-editar btn-editar"></i>
							</a>
							<a onClick="abrirmodal({{ $typology->id }})">
								<i class="grid-apagar btn-eliminar"></i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="blue-pagination d-flex justify-content-end">
			{{ $typologies->appends(request()->query())->links() }}
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$('#fixed-search').click(function() {
		$('#searchbar').toggleClass('show');
	});

	function abrirmodal(id) {
		$('#formeliminar').attr('action', '/definicoes/c/topologias/' + id);
		$('#elimodal').addClass('show');
	};

	$('#fechar-elimodal').click(function(event) {
		event.preventDefault();
		$('#elimodal').removeClass('show');
	});
</script>
@endsection