<?php $this->layout("adm-template::template",[
    "title"=>"RESERVAS",
    "top" => "RESERVAS",
    "description"=>"RESERVAS"
]); ?>



<div class="row">
        <form action="<?=URL?>/adm/reservas/filter" method="post">
            <div class="row">

                <div class="col s12 m2 input-field">
                    <select name="criterio" id="">
                        <option value="cliente" disabled selected>Pesquisar por</option>
                        <option value="cliente" >Cliente</option>
                        <option value="codigo" >Codigo</option>
                        <option value="filme" >Filme</option>
                    </select>
                </div> 
                <div class="col s12 m3 input-field">
                    <input type="text" name="termo" placeholder="Digite o termo de pesquisa" value="<?=($_GET['termo']??'')?>">
                </div> 
                <div class="col s12 m2 input-field">
                    <input type="submit" value="PesQuIsAR" class="btn blue">
                </div>     
            </div>
        </form>    
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CLIENTE</th>
                        <th>FILME</th>
                        <th>DATA DE EXIBIÇÃO</th>
                        <th>LUGARES</th>
                        <th>CINEMA</th>
                        <th>ESTADO</th>
                        <th>ACÇÕES</th>
                        <th>#</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($reservas as  $dado): ?>
                    <tr>
                        <td><?=$dado['ID_RESERVA']?></td>
                        <td><?=$dado['CLIENTE']?></td>
                        <td>
                            <a href="<?=URL."/adm/filmes/{$dado['ID_FILME']}/sessoes"?>" class="link">
                                <?=$dado['FILME']?>
                            </a>
                        </td>
                        <td><?=$dado['DATA']?></td>
                        <td><?=$dado['LUGARES']?></td>
                        <td><?=$dado['CINEMA']?></td>
                        <td>
                            <?php if($dado['ESTADO']==0):?>
                                <span class="" style="padding: 5px;font-size:0.9em;border:1px solid white;background-color:lightseagreen;color:white;">Pendente</span>
                            <?php elseif($dado['ESTADO']=='-1'):?>
                                <span class="orange" style="padding: 5px;font-size:0.9em;border:1px solid white;background-color:orangered;color:white;">Cancelada</span>
                            <?php else: ?>
                                <span style="padding: 5px;font-size:0.9em;border:1px solid white;background-color:green;color:white;">Confirmada</span>
                            <?php endif ?>
                            <!-- <?=$dado['ESTADO']?></td> -->
                        <td style="display: flex;">
                            <a href="<?=URL?>/adm/reservas/<?=$dado["ID_RESERVA"]?>/confirmar" style="margin-right:4px;" class="btn btn-floating btn-small green <?=($dado['ESTADO']!=0)?'disabled':''?>">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="<?=URL?>/adm/reservas/<?=$dado["ID_RESERVA"]?>/cancelar" style="margin-right:4px;" class="btn btn-small orange btn-floating <?=($dado['ESTADO']!=0)?'disabled':''?>">
                            <i class="fa " style="margin-right:2px;font-family: arial;font-size:0.8rem;">x</i>
                            </a>
                        </td>
                        <td>
                            <a href="<?=URL?>/adm/bilhetes/<?=$dado['ID_RESERVA']?>/" class="btn btn-small blue">BILHETES</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
    <ul class="pagination center">
       <!-- /<?php //foreach($links as $link): ?> -->
            <?=$links?>
        <!-- <?php //endforeach;?> -->
    
    </ul>






