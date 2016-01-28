<h2><?= $sector ;?> - listagem</h2>                     
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
            <?php 
                if($campos_tabela){
                    $colunas = 0;
                    
                    /*echo '<th scope="col" class="rounded-company"></th>';*/
                    foreach($campos_tabela as $cab_tabela){
                        echo '<th scope="col" class="rounded">' . $cab_tabela . '</th>';
                        $colunas++;
                    }
                    echo '<th scope="col" class="rounded">Editar</th>';
                    echo '<th scope="col" class="rounded-q4">Excuir</th>';
                }
            ?>
        </tr>
    </thead>
    <tbody>
    	<?php
            if(!empty($lista)){
                foreach($lista as $linhas){
                    echo '<tr>';
                    /*echo '<td><input type="checkbox" name="" /></td>';*/
                    
                    foreach ($linhas as $linhas_item){
                        echo '<td>' . $linhas_item . '</td>';
                    }    

                    echo '<td><a href="' . base_url($sector . '/editar/id/' . $linhas['ID']) . '"><img src="' . base_url('assets/img/template/images/user_edit.png') . '" alt="Editar" title="Editar" border="0" /></a></td>';
                    echo '<td><a href="' . base_url($sector . '/delete/id/'. $linhas['ID']) . '" class="ask"><img src="' . base_url('assets/img/template/images/trash.png') . '" alt="Excluir" title="Excluir" border="0" /></a></td>';
                    echo '</tr>';                                
                }
            }
        ?>
    </tbody>
    <tfoot>
    	<tr>
            <td colspan="<?= $colunas + 1 ;?>" class="rounded-foot-left"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</em></td>
            <td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
</table>
     <a href="cadastro" class="bt_blue"><span class="bt_blue_lft"></span><strong>Novo aluno</strong><span class="bt_blue_r"></span></a>
     <!-- <a href="" class="bt_red"><span class="bt_red_lft"></span><strong>Excluir selecionados</strong><span class="bt_red_r"></span></a> -->
     
     
        <div class="pagination">
        <span class="disabled"><< prev</span><span class="current">1</span><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a>…<a href="">10</a><a href="">11</a><a href="">12</a><a href="">next >></a>
        </div>   