@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
				<div class="card-header" align="center" style="background-color: #80bfff;">
					<h1>{{ $postagem->titulo }}</h1>
				</div>
				<div class="card-body" align="center">
					<div class="card-body">
						<p style="font-size: 20px; text-justify: auto;">{{ $postagem->descricao }}</p>
						@if ($postagem->imagem != "")
							<img class="imagem_post" style="border-width: 1px; border-style: solid; border-color: grey" src="{{ URL::to("/") . "/" . $postagem->imagem }}" alt="{{ $postagem->titulo }}">    
						@endif
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
