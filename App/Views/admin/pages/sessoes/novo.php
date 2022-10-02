<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Filmes",
    "description" => $filme->getTitulo()." - NOVA SESSÃO",
    "title"      => "CADASTRAR SESSAO"
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/sessoes/store" method="post">
        <input type="hidden" name="id_filme" value="<?=$filme->getId()?>">
        <div class="row">
            <div class="col s12 m3  input-field">
                <select name="cinema" id="cinema">

                    <option value="" selected disabled>Cinema</option>
                    <?php foreach($cinemas as $dado): ?>
                        <?php if( (Session::get("usuario")['id_cinema']==$dado['ID_CINEMA']) || Session::get("usuario")['nivel']=='admin' ): ?>
                        <option value=<?=$dado['ID_CINEMA']?>><?=$dado['NOME']?></option>
                        <?php endif;?>
                    <?php endforeach;?>

                </select>
            </div> 
            <div class="col s12 m3  input-field">
                <select name="id_sala" id="salas">
                    <option value="" disabled selected>Sala</option>
                </select>
            </div>
            <div class="col s12 m4 input-field">
                <input type="number" name="preco" id="" min="0" max="999999" required>
                <label for="preco" id="p">Preço</label>
            </div>

             
        </div>
        <div class="row">
            <div class="col s12 m3  input-field">
                <span>Data</span>
                <!-- <label for="data">Data</label> -->
                <input type="date" name="data" id="" required>
            </div> 
            <div class="col s12 m3  input-field">
                <span>Hora</span>
                <!-- <label for="data">Hora</label> -->
                <input type="time" name="hora" id="" required>
            </div>

             
        </div>
        
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn green">
                <a href="<?=URL?>/adm/filmes/<?=$filme->getId()?>/sessoes" id="cancel" class="btn red">VOLTAR</a>
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


    $(document).ready(function(){
        
        $('#cinema').change(function(){
            var idCinema = $('#cinema').val();
            $.ajax({
            url: URL+'/cinemas/'+idCinema+'/salas',
            type: 'get',
            beforeSend:function(){

            },
            success:function(data){
                $('#salas').html(data);
                $('#salas').material_select();
            },
            error:function(data){
           //     alert("ERRO AO BUSCAR RUAS");
            }
        });
       
        });
    });

</script>