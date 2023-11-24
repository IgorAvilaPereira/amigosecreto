<?php  
    $URL = "https://amigosecretoigor.000webhostapp.com/";
    if (!isset($_POST['vetParticipante'])) die("Acesso proibido!");
    $vetParticipante = $_POST['vetParticipante'];
    $i = 0;
    if (is_array($vetParticipante)) {
        while ($i < count($vetParticipante)){
            if (empty($vetParticipante[$i])){
                die("Erro no cadastro do participante:".($i+1));
            }
            $i++;
        }       
    } else {
        die("Cadastro incorreto de participantes");
    }
    $vetAmigo = $vetParticipante;    
    $vetAmigoPossivel = $vetParticipante;
    // $vetEmail = $_POST['vetEmail'];  
    $vetAmigo = [];
    $i = 0;
    if (is_array($vetAmigo) && is_array($vetParticipante)){
        if (count($vetParticipante) > 0 /*&& count($vetAmigo) > 0 && count($vetParticipante) == count($vetAmigo)*/){
            foreach($vetParticipante as $participante){   
                shuffle($vetAmigoPossivel);  
                $indicePossivelAmigo = 0;
                $possivelAmigo = $vetAmigoPossivel[$indicePossivelAmigo];
                while ($participante == $possivelAmigo || in_array($possivelAmigo, $vetAmigo)){            
                    if ($indicePossivelAmigo < count($vetAmigoPossivel)) {
                        // shuffle($vetAmigoPossivel);  
                        $possivelAmigo = $vetAmigoPossivel[$indicePossivelAmigo];
                        $indicePossivelAmigo++;
                    } else {
                        // shuffle($vetAmigoPossivel);  
                        // $indicePossivelAmigo = 0;
                        // $possivelAmigo = $vetAmigoPossivel[$indicePossivelAmigo];
                        die("Erro na geração do amigo secreto. Favor reiniciar o processo!");
                    }
                }
                $vetAmigo[$i] = $possivelAmigo;  
                // array_splice($vetAmigoPossivel, $indicePossivelAmigo, 1);     
                
                $i++;
            }
            $i = 0;
            $chaveEvento = uniqid(true);
            echo "<h1> Evento Criado com sucesso <h1>";
            echo "<h2> Chave do evento:".$chaveEvento."<h2>";            
            echo "<h3> Informe aos participantes a chave do evento e suas chaves pessoais:</h3>";
            $myfile = fopen($chaveEvento.".txt", "w") or die("Unable to open file!");
            while ($i < count($vetParticipante)){                
                $chave = uniqid(true);
                echo  $vetParticipante[$i]." => <b>Chave Evento:</b>".$chaveEvento." <b>Chave Pessoal:</b>".$chave."<br><br>";
                // participanteX tirou amigoY
                $linha = $chave.";".$vetParticipante[$i].";".$vetAmigo[$i]."\n";
                fwrite($myfile, $linha);
                $i++;
            }
            echo "<h3> Todos os participantes devem acessar: <a href='".$URL."'> $URL </a> e VERIFICAR seu amigo (usando a chave do evento e sua chave pessoal) </h3>";
            echo "<a href='$URL'> Voltar </a>";
            fclose($myfile);           
        }  else {
            echo "<h1> - Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
            echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";    
        }
    } else {
        echo "<h1> Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
        echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";
    }
?>