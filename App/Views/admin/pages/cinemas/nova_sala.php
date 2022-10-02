<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Cinemas",
    "description" => $cinema['NOME']." - Adicionar Sala",
    "title"      => "Adicionar Sala"
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/cinemas/<?=$cinema['ID_CINEMA']?>/nova-sala" method="post">
        <input type="hidden" name="id_cinema" value="<?=$cinema['ID_CINEMA']?>">
        <div class="row">

            <div class="col s12 m4 push-m1 input-field">
                <input type="text" name="number" id="" required>
                <label for="titulo" id="p">NUMERO</label>
            </div>
            <div class="col s12 m3  push-m2 input-field">
                <input type="number" name="capacity" id="capacidade" required min='10' max="99">
                <label for="capacity">Capacidade</label>
            </div>
        </div>
        
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn blue">
                <a href="<?=URL?>/adm/cinemas/<?=$cinema['ID_CINEMA']?>/" id="cancel" class="btn red">VOLTAR</a>
            </div>

            <?php if(Session::has("error") || Session::has("sucess")): ?>
                <!-- Modal Structure -->
                <div id="modals" class="modal">
                <div class="modal-content">
                    <?php if(Session::has("error")): ?>
                        <h5 class="red-text center"><?=Session::free("error")?></h5>
                    <?php elseif(Session::has("sucess")):?>
                        <h5 class="green-text center"><?=Session::free("sucess")?></h5>
                    <?php endif;?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="modal-close waves-effect waves-green btn-flat">OK</a>
                </div>
                </div>
            <?php endif; ?>
        </div>
    </form>
</div>

<script src="<?=URL?>/resources/assets/jquery-3.3.1.min.js"></script>

<script src="<?=URL?>/resources/assets/materialize/js/materialize.js"></script>
<script>
var URL = "<?=URL?>";
$('select').material_select();


$.ajax({
            url: URL+'/ruas',
            type: 'get',
            beforeSend:function(){

            },
            success:function(data){
                $('#rua').html("<option value='' disabled selected>Localizacao</option>"+data);
                $('#rua').material_select();
            },
            error:function(data){
                alert("ERRO AO BUSCAR RUAS");
            }
        });
        var Cidade = $('#cidade');
        console.log(Cidade)


$('#cidade').change(function(){
    console.log('ffff');
        var idCidade = $('#cidade').val();
        var id = document.getElementById("cidade");
        console.log(id.innerText);
        console.log("HEY "+idCidade+id.textContent);
        alert(idCidade);
        $.ajax({
            url: '/cidades/'+1+'/ruas',
            type: 'get',
            beforeSend:function(){

            },
            success:function(data){
                $('#ruas').html(data);
                $('#ruas').material_select();
            },
            error:function(data){
           //     alert("ERRO AO BUSCAR RUAS");
            }
        });
    })
</script>