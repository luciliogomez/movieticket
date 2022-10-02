<?php $this->layout("adm-template::template",[
    "title"=>"Reservas",
    "top" => "Reservas",
    "description"=>"Reservas Eliminadas"
]); ?>


<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Numero da Reserva</th>
                        <th>CLIENTE</th>
                        <th>LUGARES</th>
                        <th>FUNCIONARIO</th>
                        <th>ACÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($reservas as  $dado): ?>
                    <tr>
                        <td><?=$dado['ID_AUDITORIA']?></td>
                        <td><?=$dado['ID_RESERVA']?></td>
                        <td><?=$dado['CLIENTE']?></td>
                        
                        <td><?=$dado['LUGARES']?></td>
                        <td><?=$dado['FUNCIONARIO']?></td>
                        <td style="display: flex;">
                            <a href="<?=URL?>/adm/funcionarios/<?=$dado["ID_FUNCIONARIO"]?>/edit" style="margin-right:4px;" class="btn btn-floating btn-small blue <?=($dado['ESTADO']!=0)?'disabled':''?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="<?=URL?>/adm/funcionarios/<?=$dado["ID_FUNCIONARIO"]?>/delete" style="margin-right:2px;" class="btn btn-floating btn-small red">
                                <i class="fa fa-trash"></i>
                            </a>
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






