<?php

class Validade
{
    // private $ok;

    public function __construct()
    {
        // $this->ok = true;
    }

    public function valida()
    {

        $codigo = ["gerar.php", "index.html", "validade.php", "verificar.php", ".git", "README.md"];

        if ($handle = opendir('.')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && !in_array($entry, $codigo)) {
                    // echo "$entry <br>";
                    $data_expira_amigo_secreto = date('Y-m-d', strtotime('+1 year', filectime($entry)));
                    $data_expira_amigo_secreto = explode("-", $data_expira_amigo_secreto);
                    $data_atual = date("Y-m-d");
                    $data_atual = explode("-", $data_atual);
                    // 2024, 2025 e etc. >= 2023+1
                    // echo var_dump($data_atual);
                    // echo var_dump($data_expira_amigo_secreto); 
                    // echo $data_atual[2].">=".$data_expira_amigo_secreto[2];
                    if ($data_atual[2] >= $data_expira_amigo_secreto[2]) {
                        // se for 2024 tenho que verificar o mes
                        if ($data_atual[2] - $data_expira_amigo_secreto[2] == 0) {
                            // se for o mesmo ano, tenho que verificar o mes. se o mes for maior => deleta
                            if ($data_atual[1] > $data_expira_amigo_secreto[1]) {
                                unlink($entry);
                            }
                            // se for o mesmo mes mas o dia eh maior => deleta
                            else if ($data_expira_amigo_secreto[1] == $data_atual[1] && $data_atual[0] > $data_expira_amigo_secreto[0]) {
                                unlink($entry);
                            }
                            // se o dia for igual, ainda resta este dia
                        } else {
                            // se a diferença for maior => deleta
                            unlink($entry);
                        }
                    }
                }
            }
            closedir($handle);
        }
    }
}

?>
