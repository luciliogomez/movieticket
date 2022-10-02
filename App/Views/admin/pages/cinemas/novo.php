<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Cinemas",
    "description" => "CADASTRAR NOVO CINEMA",
    "title"      => "CADASTRAR CINEMAS"
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/cinemas/store" method="post">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="nome" id="" required>
                <label for="titulo" id="p">NOME</label>
            </div>

             <div class="col s12 m3  input-field">
                <select name="cidade" id="cidade">

                    <option value="" selected disabled>Cidade</option>
                    <?php foreach($cidades as $cidade): ?>
                        <option value=<?=$cidade['id_cidade']?>><?=$cidade['nome']?></option>
                    <?php endforeach;?>

                </select>
            </div> 
            <div class="col s12 m3  input-field">
                <select name="id_rua" id="ruas">
                    <option value="" disabled selected>Rua</option>
                </select>
            </div>
        </div>
        
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn green">
                <a href="<?=URL?>/adm/cinemas" id="cancel" class="btn red">VOLTAR</a>
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
        
        $('#cidade').change(function(){
            
            var idCidade = $('#cidade').val();
            $.ajax({
            url: URL+'/cidades/'+idCidade+'/ruas',
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
       
        });
    });

</script>