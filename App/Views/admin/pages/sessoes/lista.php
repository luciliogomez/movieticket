<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "title"=>"SESSOES",
    "top" => "SESSOES",
    "description"=>"Sessões"
]); 

?>




<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FILME</th>
                        <th>CINEMA</th>
                        <th>SALA</th>
                        <th>DATA</th>
                        <th>PRECO</th>
                        <th>LUGARES LIVRES</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($sessoes as  $dado): ?>

                    <tr  class="<?=(strtotime(date("d-m-Y")) > strtotime($dado['DATA']) )?'disable':''?>" >
                        <td><?=$dado['ID']?></td>
                        <td>
                            <a href="<?=URL."/adm/filmes/{$dado['ID_FILME']}/sessoes"?>" class="link">
                                <?=$dado['TITULO']?>
                            </a>
                        </td>
                        <td><?=$dado['CINEMA']?></td>
                        <td><?=$dado['SALA']?></td>
                        <td><?=$dado['DATA']?></td>
                        <td><?=$dado['PRECO']?></td>
                        <td><?=$dado['LUGARES DISPONIVEIS']?></td>
                        <!-- <td>
                            <a href="<?=URL?>/adm/filmes/<?=$cinema["ID_FILME"]?>/show" class="btn btn-floating blue">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td> -->
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






