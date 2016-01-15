<h2>Alunos - listagem</h2>                     
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded">Product</th>
            <th scope="col" class="rounded">Details</th>
            <th scope="col" class="rounded">Price</th>
            <th scope="col" class="rounded">Date</th>
            <th scope="col" class="rounded">Edit</th>
            <th scope="col" class="rounded-q4">Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="6" class="rounded-foot-left"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
    	<?php
            $listAlunos = 1;
            while($listAlunos <= 10):
        ?>
        <tr>
            <td><input type="checkbox" name="" /></td>
            <td>Product name</td>
            <td>details</td>
            <td>150$</td>
            <td>12/05/2010</td>

            <td><a href="#"><img src="<?= base_url('assets/img/template/images/user_edit.png');?>" alt="" title="" border="0" /></a></td>
            <td><a href="#" class="ask"><img src="<?= base_url('assets/img/template/images/trash.png');?>" alt="" title="" border="0" /></a></td>
        </tr>
        <?php
            $listAlunos++;
            endwhile;
        ?>
    </tbody>
</table>
     <a href="#" class="bt_blue"><span class="bt_blue_lft"></span><strong>Novo aluno</strong><span class="bt_blue_r"></span></a>
     <a href="#" class="bt_red"><span class="bt_red_lft"></span><strong>Excluir selecionados</strong><span class="bt_red_r"></span></a> 
     
     
        <div class="pagination">
        <span class="disabled"><< prev</span><span class="current">1</span><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a>…<a href="">10</a><a href="">11</a><a href="">12</a><a href="">next >></a>
        </div>   