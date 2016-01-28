<?php
if($perfil){
    foreach ($perfil as $aluno):
?>    
    <h1><?= $aluno['nome']; ?></h1>
<?php
endforeach;
}
?>
    <div class="left metade">    
        <h2>Data de nascimento: </h2>
        <h2>Email</h2>
        <h2>RG: </h2>
        <h2>Telefone residencial: </h2>
        <h2>Endereço:</h2>
        <h2>Bairro:</h2>
    </div>
    <div class="left metade">    
        <h2>&nbsp;</h2>
        <h2>Login: </h2>
        <h2>CPF: </h2>
        <h2>Telefone celular: </h2>
        <h2>CEP:</h2>
        <h2>Cidade:</h2>
    </div>