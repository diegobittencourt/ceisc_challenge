@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>NOVA POSTAGEM</h4></div>

                <div class="card-body">
                    <div class="container">
                        <p id="mensagem"></p>
						
						<div class="form-group">
							<label for="insere-titulo">Título</label>
							<input type="text" class="form-control" id="insere-titulo" placeholder="Titulo do Post">
						</div>
						<div class="form-group">
							<label for="insere-descricao">Descrição</label>
							<textarea class="form-control" id="insere-descricao" rows="4" placeholder="Descrição do Post"></textarea>
						</div>
						
						<div class="form-group">
							<label for="img_post">Imagem</label>
							<input type="file" class="form-control-file" id="insere-imagem">
						</div>
						
                        <div class="form-group" id="progresso-upload">
                            <div id="progresso">
                                <div id="barra-progresso"></div>                            
                            </div>
                            <section id="porcentagem-barra">0 %</section>
                        </div>
                        <div class="d-flex">
                            <span>
                                <br><button type="button" id="botao-form" class="btn btn-primary mr-2">Salvar</button>
                                <input type="checkbox" id="check-publicado">
                                <label for="check-publicado">Publicar post agora mesmo</label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset("js/jquery.js") }}"></script>
<script src="{{ asset("js/novo_post.js") }}"></script>
<script>

$(document).ready(function(){
    $("#botao-form").on("click", function(){
        if ($("#insere-titulo").val() != ''){
            cria_post();
        }else{
            alert("Título deve ser preenchido!");
        }
    });
});

function cria_post(){
    var form_data = new FormData();
    var imagem = $("#insere-imagem")[0].files[0];
    var publicar = $("#check-publicado").is(":checked");
    form_data.append('publicar', publicar);
    form_data.append('imagem', imagem);
    form_data.append("descricao", $("#insere-descricao").val());    
    form_data.append('titulo', $("#insere-titulo").val());
    var ajaxReq = $.ajax({
        url         : "{{URL::to('posts/novo')}}",
        type        : 'POST',
        headers     : {'X-CSRF-Token': '{{ csrf_token() }}'},
        data        : form_data,
        // dataType    : 'json',
        cache       : false,
        contentType : false,
        processData : false,
        xhr: function () {
            var xhr = $.ajaxSettings.xhr();
            xhr.upload.onprogress = function (event) {
                var perc = Math.round((event.loaded / event.total) * 100);
                $("#barra-progresso").width(perc + "%");
                $("#porcentagem-barra").text(perc + "%");
            };
            return xhr;
        }
    });
    ajaxReq.done(function(){
        $("#mensagem").css("color", "green");
        mostra_mensagem("Post criado com sucesso!");
        limpa_form();
    });
    ajaxReq.fail(function(){
        limpa_form();
        $("#mensagem").css("color", "red");
        mostra_mensagem("Erro ao salvar post. Tente novamente mais tarde!");
    });
}

function mostra_mensagem(mensagem){
    $("#mensagem").text(mensagem);
        $("#mensagem").fadeIn();
        setTimeout(function(){
            $("#mensagem").fadeOut();
        }, 2500);
}

function limpa_form(){
    $("#insere-titulo").val("");
    $("#insere-imagem").val("");
    $("#insere-descricao").val("");
    $("#insere-descricao").css("height", "60px");
    $("#check-publicado").prop("checked", false);
    setTimeout(function(){
        $("#barra-progresso").width(1 + "%");
        $("#porcentagem-barra").text(0 + "%");
    }, 2600);
}
</script>