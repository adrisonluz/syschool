<h2><?= $sector; ?> - extrato</h2>                     

<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    <thead>
        <tr>
            <th scope="col" class="rounded" style="text-transform: capitalize;">ID</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Data</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Hora Abertura</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Hora Fechamento</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Saldo Inicial</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Saldo Final</th>        
        </tr>
    </thead>
</thead>
<tbody>
    <?php
    if (!empty($lista)) {
        foreach ($lista as $linhas) {
            echo '<tr>';
            /* echo '<td><input type="checkbox" name="" /></td>'; */
            foreach ($linhas as $linhas_key => $linhas_item) {
                if ($linhas_item == '') {
                    echo '<td>Caixa nem aberto.</td>';
                } else {
                    echo '<td>' . $linhas_item . '</td>';
                }
            }
            echo '</tr>';
            $comentario = '';
        }
    } else {
        $comentario = 'Não existe movimentação de caixa ainda.';
    }
    ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="6" class="rounded-foot-left"><em><?= $comentario; ?></em></td>
    </tr>
</tfoot>
</table>
<a href="hoje" class="bt_blue"><span class="bt_blue_lft"></span><strong>Caixa Hoje</strong><span class="bt_blue_r"></span></a>
<!-- <a href="" class="bt_red"><span class="bt_red_lft"></span><strong>Excluir selecionados</strong><span class="bt_red_r"></span></a> -->

<!--
<div class="pagination">
    <span class="disabled"><< prev</span><span class="current">1</span><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a>…<a href="">10</a><a href="">11</a><a href="">12</a><a href="">next >></a>
</div>
-->