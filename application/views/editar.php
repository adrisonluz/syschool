<?php
$dados = $infos[0];
?>
<h2>
    <?php
    foreach ($dados as $linhas_key => $linhas_item)
        if (strpos($linhas_key, 'nome')) {
            echo $linhas_item;
        }
    ?> 
    - editar
</h2> 

<div class="form">
    <?php
    echo $form;
    ?>
</div>  
