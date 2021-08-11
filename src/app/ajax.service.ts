 /******************************************************************************************
 * Autor: Bernardo Manuel Segura Muñoz
 * Fecha: 07/11/2018
 * Fecha Actualizacion: 27/11/2018
 * Lenguaje: TypeScript
 * Tipo: libreria para poder aceder a las llamadas de get,post, put y delete desde angular
 * Descripción: Archivo que contiene clases la cuales permite enviar peticiones GET, POST, PUT, 
 *         y DELETE para el desarrollo de sistemas en entorno web con angular.
 * Nombre: ajax.service
 * Version: Beta
 ********************************************************************************************/
 /* Uso
 import { AjaxService } from './ajax.service';

 private ajax: AjaxService;

ajax.get('http://ejemplocoppel/api/modulo/xxx.php',{variable: valor}).subscribe((resp)=>{
      console.log(resp); //Respuesta de la peticion 
    },
    (error)=>{
      console.log(error); //Error de la peticion
    });

  Uso del la descarga
 this.ajax.descargar(
     {
       url: 'url', 
       nombre:'nombre.tipo' // nombre de archivo ya que se descarge
     },
     {
       parametro: "a enviar"
      }).subscribe(()=> console.log("accion al descargar")); // el subscribe puede omitirse   
      
  Uso Subir Archivo
  en html
    <input type="file"  (change)="archivo = $event.target.files[0]" >
  en ts
    archivo: File;
    this.ajax.subir({url:"url", "archivo": this.archivo (varisable creada)}).subscribe((resp)=>{
    console.log(resp);
  });
  **Nota por parte del servidor utilizar la api para cahar el archivo por el metodo post y la libreria $_FILE de PHP
    */
import { map } from 'rxjs/operators';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { Subject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AjaxService {

  private endDownload = new Subject();

  constructor(private http: HttpClient) { }

  get(_urlServicio: string,_params: any = {}) {
  	let separador = '?';
  	for(const obj in _params)
  	{
  		_urlServicio += separador + obj + '=' + encodeURIComponent(_params[obj]);
  		separador = '&';
  	}
    return this.http.get<any>(_urlServicio).pipe(map((resp) => {
      return resp;
    }));
  }

post(_urlServicio: string,_params: any = {}) {
    return this.http.post<any>(_urlServicio, _params).pipe(map((resp) => {
      return resp;
    }));
  }
 
put(_urlServicio: string,_params: any = {}) {
    return this.http.put<any>(_urlServicio, _params).pipe(map((resp) => {
      return resp;
    }));
  }

delete(_urlServicio: string,_params: any = {}) {
    return this.http.delete<any>(_urlServicio, _params).pipe(map((resp) => {
      return resp;
    }));
  }

 descargar(_archivo: any, _params: any={}): Observable<any>
  {
    let separador = '?';
    for(const obj in _params)
    {
      _archivo.url += separador + obj + '=' + encodeURIComponent(_params[obj]);
      separador = '&';
    }

  if(!_archivo.nombre)
    _archivo.nombre = '';

    this.http.get(_archivo.url,{responseType: 'blob'})
      .pipe(map((resp) => {
       return resp;
      })).subscribe((data) =>{ this.download(data, _archivo.nombre);}, (error) => {console.log("Error al descargar: " + _archivo.url,error)});

    return this.endDownload.asObservable();   
  }

  subir(_file: any)
  {
     const formData = new FormData(); 
      formData.append('fileSend', _file.archivo, _file.archivo.name); 
      return this.http.post(_file.url, formData);
  }

  private download(data: any, nombreArchivo: string): void
  {
    const blob = new Blob([data], { type: 'application/octet-stream'});
    const url= window.URL.createObjectURL(blob);
    var anchor = document.createElement("a");
    anchor.download = nombreArchivo;
    anchor.href = url;
    anchor.click();
    this.endDownload.next();
  } 
}

