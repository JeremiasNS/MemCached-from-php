<?php # Inclusão de paginas externas	
	include "menu.php";
	include "estilo.css";
	include( "conexaoMemcached.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ReversoClip</title>

<body class="geral">
    <div class="corpo">
    	<form class="form" id="cadastroCache" name="cadastroCache" method="post" action="index.php?funcao=gravaCache">
          <table width="482" border="0" align="center" cellspacing="15" class="tab">
            <tr>
              <td width="73" height="27">Chave:</td>
              <td width="596"><label for="chave"></label>
                <label for="valor"></label>
              <input name="chave" type="text" class="tfModelo" id="chave" value="" size="60" /></td>
            </tr>
            <tr>
              <td>Valor:</td>
              <td><input name="valor" type="text" class="tfModelo" id="valor" size="60" /></td>
            </tr>
            <tr>
              <td>Tempo:</td>
              <td><input name="tempo" type="text" class="tfModelo" id="tempo" size="60" /></td>
            </tr>
            <tr>
              <td><a href="index.php"></a></td>
              <td><a href="index.php">
                <input class="css3button" name="button2" type="submit" class="tfModelo" id="button" value="Gravar"/>
              </a></td>
            </tr>
          </table>
    	</form>
    
		<?php
		# Recebendo dados do formulario HTML e iniciando variaveis globais
            $chave = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_STRING);
            $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
            $tempo = filter_input(INPUT_POST, 'tempo', FILTER_SANITIZE_STRING);
            $result = "Preencha todos os campos...";
            $color = "#c83838";
			
        #############Area para codigo##############
		if($chave==""){
                        $_GET['funcao'] = "limpo";
            }
			
            if($chave!="" && $valor!="" && $tempo!=""){
			
			# Verificando a chamada da função gravar
                if($_GET['funcao'] == "gravaCache"){
                    $memcache ->set($chave, $valor, false, $tempo);
					$result = "Chave Gravada com sucesso! Funcionou!";
                    $color = "#02b9aa";
                }
			# Retornando erro em caso de falha ao gravar a chave
                else{
                    $result = "Erro ao gravar a chave!";
                    $color = "#c83838";
                    }
            }
		
        ?>
        <!-- imprimindo a variavel global $result --> 
    	<p style="text-align:center; font-style:italic; font-size:18px;"><?php echo "<span style=\"color:$color;\"> $result </span> \n"; ?></p>	
    </div>
    <div class="rodape">
    	<?php include"rodape.php"?>
	</div>
</body>
</html>