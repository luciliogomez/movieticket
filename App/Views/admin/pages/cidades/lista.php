<?php $this->layout("adm-template::template",[
    "title"=>"Cidades",
    "top" => "Cidades",
    "description"=>"Cidades Cadastradas"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/cidades/create" class="btn ">ADICIONAR CIDADE</a>
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>ACÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($cidades as  $dado): ?>
                    <tr>
                        <td><?=$dado['id_cidade']?></td>
                        <td><?=$dado['nome']?></td>
                        <td>
                            <a href="<?=URL?>/adm/cidades/<?=$dado["id_cidade"]?>/" class="btn btn-floating blue">
                                <i class="fa fa-eye"></i>
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






