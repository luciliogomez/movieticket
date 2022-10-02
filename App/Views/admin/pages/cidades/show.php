<?php $this->layout("adm-template::template",[
    "title"=>$cidade['nome'],
    "top" => "Cidades",
    "description"=>"<b>".$cidade['nome']."</b> - Lista de Ruas"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/cidades/<?=$cidade['id_cidade']?>/nova-rua" class="btn ">ADICIONAR RUA</a>
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($ruas as  $dado): ?>
                    <tr>
                        <td><?=$dado['id_rua']?></td>
                        <td><?=$dado['nome']?></td>
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






