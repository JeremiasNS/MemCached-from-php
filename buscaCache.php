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
		<div style="height:25%; width:100%">
            <form class="form" id="cadastroCache" name="cadastroCache" method="POST" action="buscaCache.php?funcao=buscaCache">
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
                    <input class="css3button" name="button2" type="submit" class="tfModelo" id="button" value="Buscar" />
                  </a></td>
                </tr>
              </table>
            </form>
        </div>
      <div style="height:75%; width:90%">
        	<?php	
			# Recebendo dados do formulario HTML e iniciando variaveis globais
				$busca_chave = filter_input(INPUT_POST, 'bChave', FILTER_SANITIZE_STRING);
				$result = "Aguardando busca...";
				$color = "#ccc";
				
			#############Area para codigo##############
			
				if($busca_chave==""){
					$_GET['funcao'] = "limpo";
					}
			
			# Verificando a chamada da função de busca
				if($_GET['funcao'] == "buscaCache"){
					
				# buscando chave no CACHE
					if($memcache->get($busca_chave)){
						$result = $memcache-> get($busca_chave);
						$color = "#02b9aa";
					}
					
				# Retornando erro em caso de falha ao gravar a chave
					else{
						$result = "Chave não encontrada!";
						$color = "#c83838";
					}
				}
			?>
			
            <!-- imprimindo a variavel global $result --> 
        	<form class = "buscaDiv" id="form1" name="form1" method="post" action="">
            	<label for="taSaida"></label>
           			<textarea style="resize: none; padding: 3%; color:=(<?php $color;?>)" name="taSaida" cols="150" rows="100" disabled="disabled" 	readonly="readonly" class="taSaida" id="taSaida"><?php print $result;?></textarea>
          	</form>
          	<p>&nbsp;</p>
        </div>

      
      <p>&nbsp;</p>
</div>
	
    <div class="rodape">
    	<?php include"rodape.php"?>
	</div>
</body>
</html>
