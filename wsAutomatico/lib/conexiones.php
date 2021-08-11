<?php

define('DBFACTURAFISCALPOSTGRESQL',15);
define('BDAUDITANETSQLSERVER',226);
define('BDCONTABILIDADNUEVASQLSERVER', 334);

/*SE AGREGAN VARIABLES PARA LA CONEXION PADRE*/
define('SYSUSUARIO','sysaccesos');
define('SYSPWD','d894dab691238a6b66');
define('SYSDB','personal');
define('SYSSERVER','10.44.1.135');//PRUEBAS
define('SYSSERVERNAME','personal_conexiones');//PRODUCCIï¿½N
define('SYSSERVERNA','administracion');
//define('SYSSERVER','10.44.1.13');//PRODUCCION
//PROCEDIMIENTO ALMACENADO A UTILIZAR SAPACCESOSDATOSWEB
define('DIRECTORIOCMANEXOS',"/home/syscorreoanexos/anexos/");
define('PUERTOCMANEXOS',"22");

function obtenConexion($db)
{
	$ConexionString['conexion'] = 'DRIVER=FreeTDS;SERVERNAME='.SYSSERVERNAME.';UID='.SYSUSUARIO.';PWD='.SYSPWD.';DATABASE='.SYSDB;
	$ConexionString['mensaje'] = "";
	$ConexionString['estado'] = 0;
	try
			{
				//echo $ConexionString['conexion'];
				$con = new OdbcConnection($ConexionString['conexion']);
				//$con = odbc_connect($ConexionString['conexion']);
				$con->open();
        		$cmd = $con->createCommand();
	        	$cmd->setCommandText("{CALL SAPACCESOSDATOSWEB ($db)}");
    	    	$ds = $cmd->executeDataSet();
				$ConexionString['conexion'] = '';
				$ConexionString['mensaje'] = "OK";
				$ConexionString['conexion'] = isset($ds[0][0]) ? $ds[0][0] : '';
				$con->close();
			}
			catch(exception $ex)
					{
						$ConexionString['mensaje'] = "";
						$ConexionString['mensaje'] = $ex->getMessage();
						$ConexionString['estado'] = -2;
					}
		return $ConexionString;
}

function obtenConexionSSH($string)
{
	$result = explode(';', $string);
	$conexionAnexos['SERVER'] = '0.0.0.0';
	$conexionAnexos['UID'] = '';
	$conexionAnexos['PWD'] = '';
	for($i=0;$i < sizeof($result); $i++)
	{
		if(strpos($result[$i], 'SERVER') !== FALSE)
		{
			$tmp = explode('=',$result[$i]);
			$conexionAnexos['SERVER'] = $tmp[1];
		}
		else if(strpos($result[$i], 'UID') !== FALSE)
		{
			$tmp = explode('=',$result[$i]);
			$conexionAnexos['UID'] = $tmp[1];
		}
		else if(strpos($result[$i], 'PWD') !== FALSE)
		{
			$tmp = explode('=',$result[$i]);
			$conexionAnexos['PWD'] = $tmp[1];
		}
	}
	return $conexionAnexos;
}

function removAccents($texto)
{
	 $a = array('ï¿½','ï¿½','ï¿½','ï¿½','ï¿½','ï¿½','a');
	 $A = array('ï¿½','ï¿½','ï¿½','ï¿½','ï¿½','A');
	 $I = array('ï¿½','ï¿½','ï¿½','ï¿½','I');
	 $i = array('ï¿½','ï¿½','ï¿½','ï¿½','i');
	 $e = array('ï¿½','ï¿½','ï¿½','ï¿½','e');
	 $E = array('ï¿½','ï¿½','ï¿½','ï¿½','E');
	 $o = array('ï¿½','ï¿½','ï¿½','ï¿½','ï¿½','ï¿½','o');
	 $O = array('ï¿½','ï¿½','ï¿½','ï¿½','ï¿½','O');
	 $u = array('ï¿½','ï¿½','ï¿½','ï¿½','u');
	 $U = array('ï¿½','ï¿½','ï¿½','ï¿½','U');
	 $c = array('ï¿½','c');
	 $C = array('ï¿½','C');
	 $n = array('ï¿½','n');
	 $N = array('ï¿½','N');
	 $Y = array('ï¿½','Y');
	 $y = array('ï¿½','y');
	 $raros = array('^','ï¿½','`','ï¿½','~','_');
	 
	 for($ind=0;$ind<(sizeof($a)-1);$ind++)
	 {   
	  $texto = str_replace($a[$ind],$a[sizeof($a)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($A)-1);$ind++)
	 {   
	  $texto = str_replace($A[$ind],$A[sizeof($A)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($I)-1);$ind++)
	 {   
	  $texto = str_replace($I[$ind],$I[sizeof($I)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($i)-1);$ind++)
	 {   
	  $texto = str_replace($i[$ind],$i[sizeof($i)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($e)-1);$ind++)
	 {   
	  $texto = str_replace($e[$ind],$e[sizeof($e)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($E)-1);$ind++)
	 {   
	  $texto = str_replace($E[$ind],$E[sizeof($E)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($o)-1);$ind++)
	 {   
	  $texto = str_replace($o[$ind],$o[sizeof($o)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($O)-1);$ind++)
	 {   
	  $texto = str_replace($O[$ind],$O[sizeof($O)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($u)-1);$ind++)
	 {   
	  $texto = str_replace($u[$ind],$u[sizeof($u)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($U)-1);$ind++)
	 {   
	  $texto = str_replace($U[$ind],$U[sizeof($U)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($c)-1);$ind++)
	 {   
	  $texto = str_replace($c[$ind],$c[sizeof($c)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($C)-1);$ind++)
	 {   
	  $texto = str_replace($C[$ind],$C[sizeof($C)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($n)-1);$ind++)
	 {   
	  $texto = str_replace($n[$ind],$n[sizeof($n)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($N)-1);$ind++)
	 {   
	  $texto = str_replace($N[$ind],$N[sizeof($N)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($y)-1);$ind++)
	 {   
	  $texto = str_replace($y[$ind],$y[sizeof($y)-1],$texto);
	 }
	 for($ind=0;$ind<(sizeof($Y)-1);$ind++)
	 {   
	  $texto = str_replace($Y[$ind],$Y[sizeof($Y)-1],$texto);
	 }
	 
	 for($ind=0;$ind<(sizeof($raros)-1);$ind++)
	 {   
	  $texto = str_replace($raros[$ind],$raros[sizeof($raros)-1],$texto);
	 }
	 
	 return $texto;
}
?>