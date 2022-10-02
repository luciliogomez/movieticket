<?php $this->layout("adm-template::template",[
    "title"=>"Cinemas",
    "top" => "Cinemas",
    "description"=>"Lista de Cinemas"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/cinemas/create" class="btn ">NOVO CINEMA</a>
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>LOCALZAÇÃO</th>
                        <th>ACÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($cinemas as  $cinema): ?>
                    <tr>
                        <td><?=$cinema['ID_CINEMA']?></td>
                        <td><?=$cinema['NOME']?></td>
                        <td><?=$cinema['LOCALIZACAO']?></td>
                        <td>
                            <a href="<?=URL?>/adm/cinemas/<?=$cinema["ID_CINEMA"]?>/" class="btn btn-floating blue">
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






