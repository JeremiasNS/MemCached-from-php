<?php # Inclusão de paginas externas	
	include "menu.php";
	include "estilo.css";
	include( "conexaoMemcached.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<body class="geral">
    <div class="corpo">
		<div style="height:30%; width:100%">
            <form class="form" id="cadastroCache" name="cadastroCache" method="POST" action="deletarChave.php?funcao=deletarChave">
              <table width="482" border="0" align="center" cellspacing="15" class="tab">
                <tr>
                  <td width="73" height="27">Chave:</td>
                  <td width="596"><label for="bChave"></label>
                    <label for="valor"></label>
                  <input name="bChave" type="text" class="tfModelo" id="bChave" value="" size="60" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><a href="index.php">
                    <input class="css3button" name="button2" type="submit" class="tfModelo" id="button" value="Deletar" />
                  </a></td>
                </tr>
              </table>
            </form>
        </div>
      <div style="height:70%; width:100%">
        	<?php
			# Recebendo dados do formulario HTML e iniciando variaveis globais
				$busca_chave = filter_input(INPUT_POST, 'bChave', FILTER_SANITIZE_STRING);
				$result = "Aguardando instrução...";
				$color = "#ccc";
				
			if($busca_chave==""){
					$_GET['funcao'] = "limpo";
					}
			# Verificando a chamada da função deletar
				if($_GET['funcao'] == "deletarChave"){
					if($memcache->get($busca_chave)){
						$memcache->delete($busca_chave);
						$result = "Chave deletada!";
						$color = "#c83838";
					}
				# Retornando erro em caso de falha ao gravar a chave
					else{
						$result = "Chave não encontrada!";
						$color = "#c83838";
						}
				}
			
			?>
             <!-- imprimindo a variavel global $result --> 
       	<p style="text-align:center; font-style:italic; font-size:18px;"><?php echo "<span style=\"color:$color;\"> $result </span> \n"; ?></p>
      </div>
    </div>
	
    <div class="rodape">
    	<?php include"rodape.php"?>
	</div>
</body>
</html>
