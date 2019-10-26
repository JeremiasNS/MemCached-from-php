<?php 
	include "menu.php";
	include "estilo.css";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ReversoClip</title>

<body class="geral">
    <div class="corpo">
    	<div class="imagens">
            <img class="imagensItens" src="Memcached.png"/>
    	</div>
        <div class="log">
            <?php
				$memcache = new Memcache;
				$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");
				if ($memcache){
					echo "Conexão realizada com sucesso! ";
					echo "<br>";
					}
				$version = $memcache->getVersion();
				echo "Server's version: ".$version."<br/>\n";
			?>
    	</div>
        <div class="imagens">
            <img class="imagensItens" src="mysql.png"/>
    	</div>
        <div class="log">
            <?php
				include "conexaoMySql.php";
				if (mysqli_connect_errno()) {
  					echo "Falha ao conectar com o MySQL: " . mysqli_connect_error();
  				}else{
					echo"Conexão realizada com sucesso! Versão do Cliente:" . mysqli_get_client_version() . " Conectado em: " . mysqli_get_host_info($con) . mysqli_get_server_info($con) ." / ". mysqli_get_server_info($con) . mysqli_commit($con);
					}
			?>
    	</div>
    </div>
    <div class="rodape">
    	<?php include"rodape.php"?>
	</div>
</body>
</html>