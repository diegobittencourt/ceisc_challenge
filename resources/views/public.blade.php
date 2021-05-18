{{-- / --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header" align="center" style="background-color: #80bfff;"><h1>POSTAGENS</h1></div>
                    <div class="card-body" align="center" style="width: 100%;">
					    <div class="row">
						    @if (count($postagens) > 0)
								@foreach ($postagens as $postagem)
									<div class="col-12">
										<div class="card" align="center">
											<div class="card-header" align="center" style="background-color: #e6f2ff;">
												<a href="{{ URL::to('postagem/' . $postagem->id) }}">
													<h2><b>{{ $postagem->titulo }}</b></h2>
												</a>
											</div>
											<div class="card-body" style="">
												<p style="font-size: 20px; text-justify: auto;">{{ $postagem->descricao }}</p>
												@if ($postagem->imagem != "")
													<img class="imagem_post" style="border-width: 1px; border-style: solid; border-color: grey" src="{{ URL::to("/") . "/" . $postagem->imagem }}" alt="{{ $postagem->titulo }}">    
												@endif
											</div>
										</div>
									</div>
								@endforeach
							@else
								<div class="col-12">
									<div class="alert alert-warning" role="alert">
									    Infelizmente nosso BLOG ainda não possui postagens. Volte mais tarde!
									</div>
								</div>
							@endif
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
