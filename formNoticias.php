<?php # Inclusão de paginas externas	
	include "menu.php";
	include "estilo.css";
	include "conexaoMySql.php";
		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>ReversoClip</title>

<style type="text/css">
.tfModelo {
}
</style>

<body class="geral">
    <div class="corpo">
    	<form class="form" id="cadastro" name="cadastro" method="post" action="formNoticias.php?funcao=gravar">
      <table width="500" border="0" align="center" cellspacing="15" class="tab">
        <tr>
          <td width="44" height="27">Chave:</td>
          <td width="376"><label for="chave"></label>
            <label for="titulo"></label>
          <input name="chave" type="text" class="tfModelo" id="chave" value="" size="60" /></td>
        </tr>
        <tr>
          <td>Titulo:</td>
          <td><input name="titulo" type="text" class="tfModelo" id="sobrenomenome" size="60" /></td>
        </tr>
        <tr>
          <td>Noticia:</td>
          <td><label for="taNoticia"></label>
          <textarea name="taNoticia" id="taNoticia" cols="60" rows="10"></textarea></td>
        </tr>
        <tr>
          <td><a href="index.php"></a></td>
          <td><a href="index.php">
            <input name="button2" type="submit" class="tfModelo" id="button" value="Cadastrar" />
          </a></td>
        </tr>
      </table>
    </form>
    <?php
		# Recebendo dados do formulario HTML e iniciando variaveis globais
		$chave = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_STRING);
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
        $noticia = filter_input(INPUT_POST, 'taNoticia', FILTER_SANITIZE_STRING);
		$result = "";
		$color = "#c83838";
		
		# Verificando campos vazios
		if($chave==""){
			$_GET['funcao'] = "limpo";
			}
			
		# Verificando a chamada da função gravar
		if($_GET['funcao'] == "gravar"){
			if($chave != "" && $noticia != "" && $titulo != ""){
				mysqli_query($con,"INSERT INTO tb_noticias(chave,titulo,conteudo) VALUES('$chave','$titulo','$noticia')");
				mysqli_close($con);
				$result = "Noticia Gravada com sucesso!";
                $color = "#02b9aa";
				}else{
					$result="Preencha todos os campos!";
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