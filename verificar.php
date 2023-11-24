<?php
    $chaveEvento = trim($_POST['chave_evento']);
    $chavePessoal = trim($_POST['chave_pessoal']);    
    $myfile = fopen($chaveEvento.".txt", "r") or die("Chave incorreta!");        
    while(!feof($myfile)) {
      $linha = fgets($myfile);
      $vetLinha = explode(";", $linha);
      if ($vetLinha[0] == $chavePessoal){
        echo "<h1>".$vetLinha[1].": seu amigo secreto é ".$vetLinha[2]."</h1>";
      }
    }
    fclose($myfile);
?>