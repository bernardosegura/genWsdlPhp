<?php  
/******************************************************************************************
 * Autor: Bernardo Manuel Segura Muñoz
 * Fecha-Plantilla: 07/11/2018
 * Fecha crearWSDLPHP: 20/12/2018
 * Fecha Actualizacion-crearWSDLPHP: 20/12/2018
 * Lenguaje: PHP
 * Tipo: Generador de Código Wsdl en PHP
 * Descripción: Archivo generado para optimizar tiempos en el desarrollo de
 *              Servicios Web en PHP.
 * Nombre: crearWSDLPHP
 * Versión: Beta
 ********************************************************************************************/
 error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();


 require_once '../librerias/libRest/libRest.php'; //api rest

try {
  $api = new restApi();// clase principal
//***************************************************************************************************
    $api->post = function($data)//Función para insertar datos $data es la información de entrada
    {
		$contenido_creditos = "<?php\n/******************************************************************************************\n";
		$contenido_creditos .= " * Autor: Bernardo Manuel Segura Muñoz\n";
		$contenido_creditos .= " * Fecha-Plantilla: 20/12/2018\n";
		$contenido_creditos .= " * Fecha Actualizacion-Plantilla: 20/12/2018\n";
		$contenido_creditos .= " * Fecha ServicioGenerado: ".date("d/m/Y")."\n";
		$contenido_creditos .= " * Fecha Actualizacion-ServicioGenerado: ".date("d/m/Y")."\n";
		$contenido_creditos .= " * Lenguaje: PHP\n";
		$contenido_creditos .= " * Tipo: Wsdl\n";
		$contenido_creditos .= " * Descripción: Web Service generado con la herramienta crearWSDLPHP para optimizar tiempos\n";
		$contenido_creditos .= " *         en el desarrollo de Servicios Web en PHP, utiliza libreria nusoap.php.\n";
		$contenido_creditos .= " ********************************************************************************************/\n\n";

		///*************************Creamos cabeza del documento*************************************
		$contenido_base = "";
		$contenido_cabeza = $contenido_creditos;
		$contenido_cabeza .= "header ('Content-type: text/html; charset=utf-8');\n";
		$contenido_cabeza .= "require_once('".$data->lib->ruta."');\n\n";
		$contenido_cabeza .= '$server = new soap_server();'."\n";
		$contenido_cabeza .= '$namespace = "'.$data->nombre.'wsdl";'."\n";
		$contenido_cabeza .= '$server->configureWSDL($namespace);'."\n";
		$contenido_cabeza .= '$server->wsdl->schemaTargetNamespace = "tns:". $namespace;'."\n";	
		/////////////////////////////////////////////////////////////////////////////////////////
		//->Iniciamos con los métodos
		$contenido_funcion = '';
		$contenido_metodos = '';
		$contenido_code = '';
	    foreach ($data->metodos as $metodo) 
	    {
	    	$contenido_metodos .= (($contenido_metodos == ''))?"\n\n":"";
	      	$contenido_metodos .= '$server->register("'.$metodo->nombre.'",'."\n";
	      	$contenido_funcion .= "function $metodo->nombre (";

	      	$contenido_metodos .= "  array(";
	      	$coma = '';
	      	$prefijo = "";
	      	foreach ($metodo->entrada as $variable => $valor) 
	      	{
	      		if($valor->tipo == "array" || $valor->tipo == "struct")
	      		{
	      			$prefijo = "tns";

	      			if(isset($valor->struct))
	      			{
	      				$valor->tipo = "inStruct$variable";

	      				$contenido_definiciones .= '$server->wsdl->addComplexType('."'$valor->tipo',\n";
	      				$contenido_definiciones .= "  'complexType',\n  'struct',\n  'all',  \n'',\n  array(\n";
	      				$comados = '';
	      				foreach ($valor->struct as $variableSalida => $valorSalida) 
	      				{
	      					$contenido_definiciones .= $comados."  '$variableSalida' => array('type'=>'xsd:$valorSalida')";
	      					$comados = ",\n";
	      				}
						$contenido_definiciones .= ")\n);\n\n";  
	      			}
	      			else
	      			{
	      				$valor->tipo = "inArray$variable";

	      				$tipo = '';
	      				if($valor->array->tipo == "struct")
		      			{
		      				$tipo = "inStruct$variable";

		      				$contenido_definiciones .= '$server->wsdl->addComplexType('."'$tipo',\n";
		      				$contenido_definiciones .= "  'complexType',\n  'struct',\n  'all',\n  '',\n  array(\n";
		      				$comados = '';
		      				foreach ($valor->array->struct as $variableArray => $valorArray) 
		      				{
		      					$contenido_definiciones .= $comados."  '$variableArray' => array('type'=>'xsd:$valorArray')";
		      					$comados = ",\n";
		      				}
							$contenido_definiciones .= ")\n);\n\n";  

							$tipo = "tns:".$tipo;
		      			}
		      			else
		      			{
		      				$tipo = "xsd:".$valor->array->tipo;
		      			}

	      				$contenido_definiciones .= '$server->wsdl->addComplexType('."'$valor->tipo',\n";
	      				$contenido_definiciones .= "  'complexType',\n  'array',\n  '',\n  'SOAP-ENC:Array',\n  array(array('ref'=>'SOAP:ENC:arrayType',\n 'wsdl:arrayType'=>'$tipo"."[]')),\n'$tipo');\n\n";
	      				//$contenido_definiciones .= "  'complexType',\n  'array',\n  '',\n  'SOAP-ENC:Array',\n  array(),\n  array(array('ref'=>'SOAP:ENC:arrayType',\n 'wsdl:arrayType'=>'$tipo"."[]')),\n'$tipo');\n\n";
	      			}
	      		}
	      		else
	      		{
	      			$prefijo = "xsd";
	      		}

	      		$contenido_funcion .= $coma.'$'.$variable;
	      	 	$contenido_metodos .= $coma . (($coma != '')?"\n":"") ."'$variable' => ". "'$prefijo:$valor->tipo'"; 
	      	 	$coma = ",";
	      	}
	      	$contenido_metodos .="),\n  array(";
	      	$coma = '';
	      	$contenido_definiciones = '';
	      	$return = '';
	      	foreach ($metodo->salida as $variable => $valor) 
	      	{
	      		if($valor->tipo == "array" || $valor->tipo == "struct")
	      		{
	      			$prefijo = "tns";

	      			if(isset($valor->struct))
	      			{
	      				$valor->tipo = "outStruct$variable";

	      				$contenido_definiciones .= '$server->wsdl->addComplexType('."'$valor->tipo',\n";
	      				$contenido_definiciones .= "  'complexType',\n  'struct',\n  'all',\n  '',\n  array(\n";
	      				$comados = '';

	      				foreach ($valor->struct as $variableSalida => $valorSalida) 
	      				{
	      					$contenido_definiciones .= $comados."  '$variableSalida' => array('type'=>'xsd:$valorSalida')";
	      					$comados = ",\n";
	      				}
						$contenido_definiciones .= ")\n);\n\n";  
	      			}
	      			else
	      			{
	      				$valor->tipo = "outArray$variable";

	      				$tipo = '';
	      				if($valor->array->tipo == "struct")
		      			{
		      				$tipo = "outStruct$variable";

		      				$contenido_definiciones .= '$server->wsdl->addComplexType('."'$tipo',\n";
		      				$contenido_definiciones .= "  'complexType',\n  'struct',\n  'all',\n  '',\n  array(\n";
		      				$comados = '';
		      				foreach ($valor->array->struct as $variableArray => $valorArray) 
		      				{
		      					$contenido_definiciones .= $comados."  '$variableArray' => array('type'=>'xsd:$valorArray')";
		      					$comados = ",\n";
		      				}
							$contenido_definiciones .= ")\n);\n\n";  

							$tipo = "tns:".$tipo;
		      			}
		      			else
		      			{
		      				$tipo = "xsd:".$valor->array->tipo;
		      			}

	      				$contenido_definiciones .= '$server->wsdl->addComplexType('."'$valor->tipo',\n";
	      				$contenido_definiciones .= "  'complexType',\n  'array',\n  '',\n  'SOAP-ENC:Array',\n  array(array('ref'=>'SOAP:ENC:arrayType',\n  'wsdl:arrayType'=>'$tipo"."[]')),\n'$tipo');\n\n";
	      				//$contenido_definiciones .= "  'complexType',\n  'array',\n  '',\n  'SOAP-ENC:Array',\n  array(),\n  array(array('ref'=>'SOAP:ENC:arrayType',\n  'wsdl:arrayType'=>'$tipo"."[]')),\n'$tipo');\n\n";
	      			}
	      			$return = '$'."$variable";
	      		}
	      		else
	      		{
	      			$prefijo = "xsd";
	      			$return = "'0'";
	      		}
	      		
	      		$contenido_code = (isset($metodo->code)? "\n".base64_decode($metodo->code)."\n":"\n   //+++++ Código de función aquí +++++++\n\n\n   return $return; //Retornar la respuesta según la necesidad\n");
	      		$contenido_funcion .= ")\n{ $contenido_code}\n\n";
	      		$contenido_metodos .= $coma ."'$variable' => ". "'$prefijo:$valor->tipo'"; 
	      	 	$coma = ",\n";
	    	}


	    	$contenido_metodos .="),\n  'tns:'.".'$namespace,'."\n";
	    	$contenido_metodos .="  'tns:'.".'$namespace'.".'#$metodo->nombre',\n";
	    	$contenido_metodos .="  'rpc',\n"."  'literal',\n"."'$metodo->descripcion');\n\n\n";

	    }	
		//<--Fin metodos

	    $contenido_pie = '$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '."''; \n\n".'$server->service($HTTP_RAW_POST_DATA);'."\n\n?>";

	    $contenido_base = $contenido_cabeza.$contenido_metodos.$contenido_definiciones.$contenido_funcion.$contenido_pie;


		$archivo = "wsdls/".$data->nombre.".php";
		$fbase = fopen($archivo, 'w');
		fwrite($fbase, $contenido_base);
		fclose($fbase);
		chmod($archivo, 0777);

		$dom = $_SERVER['HTTP_HOST']; //recuperamos el dominio
	    $resto = str_replace('crearWSDLPHP.php', $archivo , $_SERVER['REQUEST_URI']); //recuperamos el resto
	    $url_completa = "" . $dom . $resto . "?wsdl"; //armamos la url

		$data->urlServicio = $url_completa;

		$archivo = "wsdlsInstaller/".$data->nombre.".json";
		$fbase = fopen($archivo, 'w');
		fwrite($fbase, json_encode($data));
		fclose($fbase);
		chmod($archivo, 0777);
	
	    echo '{"url":"http://'.$url_completa.'"}';
    };
//***************************************************************************************************
 $api->start(); 


 } catch(exception $ex)
{
    echo $ex->getMessage();
}

 
?>