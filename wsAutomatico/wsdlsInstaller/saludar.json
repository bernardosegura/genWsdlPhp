<?php
/******************************************************************************************
 * Autor: Bernardo Manuel Segura Muñoz
 * Fecha-Plantilla: 20/12/2018
 * Fecha Actualizacion-Plantilla: 20/12/2018
 * Fecha ServicioGenerado: 20/12/2018
 * Fecha Actualizacion-ServicioGenerado: 20/12/2018
 * Lenguaje: PHP
 * Tipo: Wsdl
 * Descripción: Web Service generado con la herramienta crearWSDLPHP para optimizar tiempos
 *         en el desarrollo de Servicios Web en PHP, utiliza libreria nusoap.php.
 ********************************************************************************************/

header ('Content-type: text/html; charset=utf-8');
require_once('../lib/nusoap.php');

$server = new soap_server();
$namespace = "saludarwsdl";
$server->configureWSDL($namespace);
$server->wsdl->schemaTargetNamespace = "tns:". $namespace;


$server->register("saludo",
  array('nombre' => 'xsd:int'),
  array('saludo' => 'xsd:string'),
  'tns:'.$namespace,
  'tns:'.$namespace.'#saludo',
  'rpc',
  'literal',
'Manda un saludo');


$server->register("saludar",
  array('nombre' => 'xsd:int'),
  array('saludo' => 'xsd:string'),
  'tns:'.$namespace,
  'tns:'.$namespace.'#saludar',
  'rpc',
  'literal',
'Manda un saludar');


function saludo ($nombre)
{ 
   //+++++ Codigo de función aquí +++++++


   return; //Retornar la respuesta segun la necesidad
}

function saludar ($nombre)
{ 
   //+++++ Codigo de función aquí +++++++


   return; //Retornar la respuesta segun la necesidad
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ''; 

$server->service($HTTP_RAW_POST_DATA);

?>