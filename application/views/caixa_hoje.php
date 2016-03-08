<?php
$acao = ($acao == '' ? '' : ' - ' . $acao);
?>
<h2><?= $sector . $acao ?></h2> 

<div class="form">
    <?php
    echo $form;
    ?>
</div>  

<!-- Tabela de entradas -->
<br/>
<h2>Lista de entradas:</h2>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    <thead>
        <tr>
            <th scope="col" class="rounded" style="text-transform: capitalize;">ID</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Hora</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Valor</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Descrição</th>       
        </tr>
    </thead>
</thead>
<tbody>
    <?php
    if (!empty($totalEntradas)) {
        foreach ($totalEntradas as $linhasEntradas) {
            echo '<tr>';
            /* echo '<td><input type="checkbox" name="" /></td>'; */
            foreach ($linhasEntradas as $entradas_key => $entradas_item) {
                echo '<td>' . $entradas_item . '</td>';
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
        <td colspan="4" class="rounded-foot-left"><em><?= $comentario; ?></em></td>
    </tr>
</tfoot>
</table>

<!-- Tabela de saidas -->
<br/>
<h2>Lista de saidas:</h2>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    <thead>
        <tr>
            <th scope="col" class="rounded" style="text-transform: capitalize;">ID</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Hora</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Valor</th>
            <th scope="col" class="rounded" style="text-transform: capitalize;">Descrição</th>       
        </tr>
    </thead>
</thead>
<tbody>
    <?php
    if (!empty($totalSaidas)) {
        foreach ($totalSaidas as $linhasSaidas) {
            echo '<tr>';
            /* echo '<td><input type="checkbox" name="" /></td>'; */
            foreach ($linhasSaidas as $saidas_key => $saidas_item) {
                echo '<td>' . $saidas_item . '</td>';
            }
            echo '</tr>';
            $comentarioSaida = '';
        }
    } else {
        $comentarioSaida = 'Não existe movimentação de caixa ainda.';
    }
    ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="4" class="rounded-foot-left"><em><?= $comentarioSaida; ?></em></td>
    </tr>
</tfoot>
</table>