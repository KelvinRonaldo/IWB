<?php
	// variáveis crida aqui para arrumar o bug de variável indefinida
	$media = null;
	
	$nota1 = null;
	$nota2 = null;
	$nota3 = null;
	$nota4 = null;

	//ELIMINAR VARIÁVEL DA MEMÓRIA DO SISTEMA USA-SE O COMANDO 'unset'
		// unset($nome_da_variavel);
	
	// isset = verifica a existenciode uma variável ou de um objeto
	if(isset($_GET['btncalc'])){
		$nota1=$_GET['txtn1'];
		$nota2=$_GET['txtn2'];
		$nota3=$_GET['txtn3'];
		$nota4=$_GET['txtn4'];
		
/*
		is_numeric = verifica se o valor é uma NÚMERO
		is_string = verifica se o valor é uma STRING
		is_double = verifica se o valor é um DOUBLE
		is_float = verifica se o valor é um FLOAT
		is_array = verifica se o valor é um ARRAY
		is_bool = verifica se o valor é um BOOLEAN
		is_object = verifica se o valor é um OBJECT
		is_int = verifica se o valor é um INT
*/
		
		/* OUTRAS FORMAS
		if($nota1 == "" || $nota2 == "" || $nota3 == "" || $nota4 == "");
		if($nota1 != null && $nota2 != null && $nota3 != null && $nota4 != null);
		if(empty($nota1) || empty($nota2) || empty($nota3) || empty($nota4));*/
		if($nota1 == null || $nota2 == null || $nota3 == null || $nota4 == null){
			echo("<span style='color: red'>PREENCHA TODOS OS CAMPOS</span>");
		}else if(!(is_numeric($nota1) && is_numeric($nota2) && is_numeric($nota3) && is_numeric($nota4))){
			echo("<span style='color: #d86f00'>PREENCHA OS CAMPOS APENAS COM NÚMEROS</span>");
		}else{
			$media=($nota1+$nota2+$nota3+$nota4)/4;
		}


	}
	// toda estrutura de decisão que tenha apenas uma resposta, não é necessário utilizar chaves "{}"
	if($media >= 7)
		$situacao = "<span style='color: #019101; font-weight: bold; text-decoration: underline; text-shadow: 0px 0px 4px #00ff00;' >Aprovado</span>";
	else
		$situacao = "<span style='color: #bc0707; font-weight: bold; text-decoration: underline; text-shadow: 0px 0px 4px #ff0000;' >Reprovado</span>";
	

	if($media == null)
		$situacao = "";
	
?>

<html>
	<body>
		<table>
			<tr>
				<td>
					Calculo de Médias
				</td>
			</tr>
			<tr>
				<td>
					<form name="frmmedia" method="get" action="media.php">
						Nota 1:<input type="text" name="txtn1" value="<?php echo($nota1); ?>" > <br>
						Nota 2:<input type="text" name="txtn2" value="<?php echo($nota2); ?>" > <br>
						Nota 3:<input type="text" name="txtn3" value="<?php echo($nota3); ?>" > <br>
						Nota 4:<input type="text" name="txtn4" value="<?php echo($nota4); ?>" > <br>
						<input type="submit" name="btncalc" value ="Calcular" >
					</form>
				</td>
			</tr>
			<tr>	
				<td>
					<!-- @ = Esconde os erros na tela -->
					A média é: <b><?php echo($media); ?></b> <br>
					O aluno esta: <?php echo($situacao); ?>
				</td>
			</tr>
		</table>
	</body>
</html>