<?php  # Inclusão de paginas externas	
	include "menu.php";
	include "estilo.css";
	include "conexaoMemcached.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<body class="geral">
    <div class="corpo">
		<div style="height:40%; width:100%;">
            <form id="EditarChave" name="EditarChave" method="POST" action="editarChave.php?funcao=editChave">
              <table width="482" border="0" align="center" cellspacing="15" class="tab">
                <tr>
                  <td width="73" height="27">Chave:</td>
                  <td width="596"><label for="chave"></label>
                    <label for="valor"></label>
                  <input name="chave" type="text" class="tfModelo" id="chave" value="" size="60" /></td>
                </tr>
                <tr>
                  <td width="73" height="27">Valor:</td>
                  <td width="596"><label for="chave"></label>
                    <label for="valor"></label>
                  <input name="valor" type="text" class="tfModelo" id="valor" value="" size="60" /></td>
                </tr>
                
                <tr>
                  <td>&nbsp; </td>
                  <td><input name="teste" type="radio" value="antes" />
                  <label for="antes">
                  Inserir Antes</label></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="teste" type="radio" value="apos" checked="checked" />
                  <label for="antes2"> Inserir Apos</label></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><a href="index.php">
                    <input class="css3button" name="button2" type="submit" class="tfModelo" id="button" value="Editar" />
                  </a></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </form>
        </div>
      <div style="height:60%; width:100%;">
        	<?php	
				$chave = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_STRING);
				$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
				$opcao = @$_POST['teste'];
				$result = "Aguardando instrução...";
				$color = "#ccc";
				
				if($chave==""){
					$_GET['funcao'] = "limpo";
					}
				
				if($_GET['funcao'] == "editChave"){
					if($chave!="" && $valor!=""){
						if ($opcao=='apos'){
							if($memcache->get($chave)){
								$memcache->append($chave,$valor);
								$result = $memcache->get($chave,$valor);
								$color = "#02b9aa";
							}else{
								$result = "Chave não encontrada!";
								$color = "#c83838";
							}
						}
						if ($opcao=='antes'){
							if($memcache->get($chave)){
								$memcache->prepend($chave,$valor);
								$result = $memcache->get($chave,$valor);
								$color = "#02b9aa";
							}else{
								$result = "Chave não encontrada!";
								$color = "#c83838";
							}
						}
					}else{
						$result = "Preencha todos os campos!";
						$color = "#c83838";
						}
				}
			?>
        	 <form class = "buscaDiv" id="form1" name="form1" method="post" action="">
            	<label for="taSaida"></label>
           			<textarea style="resize: none; padding: 3%; color:=(<?php $color;?>)" name="taSaida" cols="150" rows="100" disabled="disabled" readonly="readonly" class="taSaida" id="taSaida"><?php print $result;?></textarea>
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
