<?php  
    $vetParticipante = $_POST['vetParticipante'];    
    $vetEmail = $_POST['vetEmail'];  
    $vetAmigo = [];
    $i = 0;
    if (is_array($vetAmigo) && is_array($vetParticipante)){
        if (count($vetParticipante) > 0 && count($vetEmail) > 0 && count($vetParticipante) == count($vetEmail)){
            foreach($vetParticipante as $participante){        
                $possivelAmigo = $vetParticipante[rand(0, count($vetParticipante)-1)];
                while ($participante == $possivelAmigo || in_array($possivelAmigo, $vetAmigo)){            
                    $possivelAmigo = $vetParticipante[rand(0, count($vetParticipante)-1)];
                }
                $vetAmigo[$i] = $possivelAmigo;        
                $i++;
            }
            $i = 0;
            $chaveEvento = uniqid(true);
            $myfile = fopen($chaveEvento.".txt", "w") or die("Unable to open file!");
            while ($i < count($vetParticipante)){
                // participanteX tirou amigoY
                $linha = uniqid(true).";".$vetParticipante[$i].";".$vetAmigo[$i]."\n";
                fwrite($myfile, $linha);
                $i++;
            }
            fclose($myfile);
            echo "<h1> Evento Criado com sucesso <h1>";
            echo "<h2> Chave do evento:".$chaveEvento."<h2>";
        }  else {
            echo "<h1> Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
            echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";    
        }
    } else {
        echo "<h1> Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
        echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";
    }
?>