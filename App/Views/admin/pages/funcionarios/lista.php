<?php $this->layout("adm-template::template",[
    "title"=>"Funcionarios",
    "top" => "Funcionarios",
    "description"=>"Lista de Funcionarios"
]); ?>


<div class="row">
    <a href="<?=URL?>/adm/funcionarios/create" class="btn ">NOVO Funcionario</a>
</div>

<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>NIVEL</th>
                        <th>CINEMA</th>
                        <th>ACÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($funcionarios as  $dado): ?>
                    <tr>
                        <td><?=$dado['id_funcionario']?></td>
                        <td><?=$dado['nome']?></td>
                        <td><?=$dado['email']?></td>
                        
                        <td><?=$dado['nivel']?></td>
                        <td><?=$dado['cinema']?></td>
                        <td style="display: flex;">
                            <a href="<?=URL?>/adm/funcionarios/<?=$dado["id_funcionario"]?>/edit" style="margin-right:4px;" class="btn btn-floating btn-small blue <?=($dado['ESTADO']!=0)?'disabled':''?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="<?=URL?>/adm/funcionarios/<?=$dado["id_funcionario"]?>/delete" style="margin-right:2px;" class="btn btn-floating btn-small red">
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






