<?php
    if (!isset($_GET['chave_evento']) || !isset($_GET['chave_pessoal'])) die("Chaves (do Evento e Pessoal) são obrigatórias para a verificação!");
    if (empty($_GET['chave_evento']) || empty($_GET['chave_pessoal'])) die("Chaves (do Evento e Pessoal) são obrigatórias para a verificação!");
  
    $chaveEvento = trim($_GET['chave_evento']);
    $chavePessoal = trim($_GET['chave_pessoal']); 

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
      die("Chave incorreta ou Evento Expirado (cada evento tem validade de 1 ano)!");
    }
?>