#
# <img src=""/> Generador de Wsdl en PHP
Es una aplicación que utiliza [Angular CLI](https://github.com/angular/angular-cli), la cual genera **web servicie** en **PHP** de manera automática.

Para poder generar un web Servicie se tiene que ingresar la siguiente información:
- **Nombre del Servicio** es el nombre de nuestro servicio web.
- Ruta de Librería **NUSOAP**, este proyecto utiliza la librería nusoap para que levante el servicio web. es necesario indicar la ruta de dicha librería, la cual por default se encuentra en el directorio de wsAutomatico.
- Método
   1. **Nombre** del método
   2. **Descripción** del método
   3. **Estructura Json Entradas** el cual se debe especificar el nombre de la variable de entrada y el tipo de la variable.
   4. **Estructura Json Salidas** el cual se debe especificar el nombre de la variable de salida y el tipo de la variable.
   5. **Código de método en PHP** se puede agregar código en php para el método o en su defecto agregar después en el archivo que se genera como plantilla.
 
# Interfaz de aplicación **Angular**
### Datos generales e inicio de datos de método
 <img src=""/>
 
### Datos de estructura de servicio
 <img src=""/>
 
### Botón que genera el servicio y al final te indica la url del mismo para su consumo
 <img src=""/>

