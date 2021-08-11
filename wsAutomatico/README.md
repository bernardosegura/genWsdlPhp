# Creación de Servicio Web de manera Dinámica
Esta parte de la aplicación es PHP y requiere de la librería [libRest](https://github.com/bernardosegura/libRest) para funcionar como un servicio **restful**.

Aquí encontramos dos directorios los cuales su funcionamiento es el siguiente:
- lib (**agregar libreria**), en este directorio se debe encontrar la librería [nusoap](http://sourceforge.net/projects/nusoap/).
- wsdls (**crear en este directorio**), es donde se genera el código php del servicio wsdl.
- wsdlsInstaller (**crear en este directorio**), es donde se guarda json que genera el wsdl enviado por parámetro desde la aplicación **Frontend**.

