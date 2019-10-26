<?php # Inclusão de paginas externas	
	date_default_timezone_set('America/Sao_Paulo');
	include "menu.php";
	include "estilo.css";
	include "conexaoMySql.php";
	include "conexaoMemcached.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<body class="geral">
    <div class="corpo">
		<div style="height:30%; width:100%">
            <form class="form" id="cadastroCache" name="cadastroCache" method="POST" action="buscaNoticia.php?funcao=buscaNoticia">
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
      <div style="height:70%; width:100%; text-align:center">
        	<?php
			# Recebendo dados do formulario HTML e iniciando variaveis globais
				$busca = filter_input(INPUT_POST, 'bChave', FILTER_SANITIZE_STRING);
				$result = "Aguardando busca...";
				
			# Verificando campos vazios
				if($busca==""){
					$_GET['funcao'] = "limpo";
					$result = "Campo de busca esta vazio...";
					}
			
			# Verificando a chamada da função de busca
				if($_GET['funcao'] == "buscaNoticia"){
					
					# Verificando a existencia em CACHE dos dados requeridos pelo usuario
						if($memcache->get($busca)){
							$inicio1 = microtime(true);
							$result = $memcache->get($busca);
							
							$total1 = microtime(true) - $inicio1;
							$BuscaCache = 'Tempo de busca no cache: ' . $total1.'ms';
							echo $BuscaCache;							
						}
					
					# Buscando dados no banco MYSQL após confirmar inexistencia dos mesmos em CACHE	
						if(!$memcache->get($busca)){
							$inicio1 = microtime(true);
							$consulta = "SELECT * FROM tb_noticias WHERE chave ='$busca'";
							$inf = $con->query($consulta);	
							$dado = $inf->fetch_array();
							$result = $dado['conteudo'];
							
							$total1 = microtime(true) - $inicio1;
							$BuscaBanco = 'Tempo de busca no banco de dados: ' . $total1.'ms';
							echo $BuscaBanco;
							
						# Gardando busca acima descrita no CACHE para atenter futuras buscas com maior agilidade
							$memcache->set($busca,(date('d/m/Y \à\s H:i:s ').$dado['conteudo']),false,60);	
							
						}
						
						# Verificando a inexistencia do dado buscano no banco MYSQL
						$consulta = "SELECT * FROM tb_noticias WHERE chave ='$busca'";
						$inf = $con->query($consulta);
						$dado = $inf->fetch_array();
						if(!$dado['chave']){
							$result = "Noticia não encontrada no banco de dados...";
							}
						
					}	
			?>
        <form class = "buscaDiv" id="form1" name="form1" method="post" action="">
            <label for="taSaida"></label>
           	<textarea style="resize: none; padding: 3%;" name="taSaida" cols="150" rows="100" disabled="disabled" readonly="readonly" class="taSaida" id="taSaida"><?php print $result;?></textarea>
          	</form>
          	<p>&nbsp;</p>
        	
        </div>

      
      
</div>
	
    <div class="rodape">
    	<?php include"rodape.php"?>
	</div>
</body>
</html>
