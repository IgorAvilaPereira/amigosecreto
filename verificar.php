<?php
    if (!isset($_POST['chave_evento']) || !isset($_POST['chave_pessoal'])) die("Chaves (do Evento e Pessoal) são obrigatórias para a verificação!");
    if (empty($_POST['chave_evento']) || empty($_POST['chave_pessoal'])) die("Chaves (do Evento e Pessoal) são obrigatórias para a verificação!");
  
    $chaveEvento = trim($_POST['chave_evento']);
    $chavePessoal = trim($_POST['chave_pessoal']); 

    if (file_exists($chaveEvento.".txt")) {
      $myfile = fopen($chaveEvento.".txt", "r") or die("Chave incorreta ou Amigo Secreto Expirado (cada evento tem validade de 1 ano)!");        
      $chavePessoalOK = false;
      while(!feof($myfile)) {
        $linha = fgets($myfile);
        $vetLinha = explode(";", $linha);
        if ($vetLinha[0] == $chavePessoal){
          echo "<h1>".$vetLinha[1].": seu amigo secreto é ".$vetLinha[2]."</h1>";
          $chavePessoalOK = true;
        }
      }
      if (!$chavePessoalOK) {
        echo "<h1> Chave pessoal incorreta </h1>";
      }
      fclose($myfile);
    } else {
      die("Chave incorreta ou Amigo Secreto Expirado (cada evento tem validade de 1 ano)!");
    }
?>