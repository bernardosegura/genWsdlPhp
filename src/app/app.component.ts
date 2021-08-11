import { Component } from '@angular/core';
import { AjaxService } from "./ajax.service"

import { ViewChild } from '@angular/core';
import { JsonEditorComponent, JsonEditorOptions } from 'ang-jsoneditor'

//import { schema } from './schema.value';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'genWsdlPhp';

  obj: string;
  nombreWs: string;
  lib: string;
  metodos: string;
  entrada: any;
  salida: any;
  code: string;
  nombreMetodo: string;
  descMetodo: string;
  servicio: string;

  //@ViewChild(JsonEditorComponent) editor: JsonEditorComponent;
  @ViewChild('editentra') editentra: JsonEditorComponent;
  @ViewChild('editSal') editSal: JsonEditorComponent;

  optionsE = new JsonEditorOptions();
  optionsS = new JsonEditorOptions();
  

  constructor(private ajax: AjaxService)
  {
  	 this.nombreWs = '';
  	 this.lib = "../lib/nusoap.php";
  	 this.metodos = "";
  	 this.entrada = {parametro:{tipo:"string"}};
  	 this.salida = {respuesta:{tipo:"string"}};
  	 this.code = "";
  	 this.nombreMetodo = "";
  	 this.descMetodo = "";
  	 this.servicio = "";

  	this.optionsE.mode = 'code';
    this.optionsE.modes = ['code', 'text', 'tree', 'view'];
    //this.options.schema = schema;
    this.optionsE.statusBar = false;
    //this.optionsE.onChange = () => this.entrada = this.editentra.get();
   

    this.optionsS.mode = 'code';
    this.optionsS.modes = ['code', 'text', 'tree', 'view'];
    this.optionsS.statusBar = false;
    //this.optionsS.onChange = () => this.salida = this.editSal.get();
  }

  generar()
  {
	this.entrada = this.editentra.get();
	this.salida = this.editSal.get();

  	if(this.nombreWs == '')
  	{
  		alert("El nombre del servicio es requerido.");
  		return;
  	}

  	if(this.lib == '')
  	{
  		alert("La librería es requerida para el funcionamiento del servicio.");
  		
  	}

  	if(this.nombreMetodo == '')
  	{
  		alert("El nombre del método es requerido.");
  		return;
  	}
  	 
  	/*if(this.entrada == '')
  	{
  		alert("El método del servicio es requerido, mínimo un método.");
  		return;
  	}*/

  	this.metodos = "[" + '{"nombre":"'+this.nombreMetodo+'","descripcion":"'+this.descMetodo+'","entrada":'+JSON.stringify(this.entrada)+',"salida":'+JSON.stringify(this.salida)+((this.code!='')?',"code":"'+btoa(this.code)+'"':'')+'}'+ "]";

  	this.obj = '{"nombre":"'+this.nombreWs+'","metodos":'+this.metodos+',"lib":{"incluir":"1", "ruta":"'+this.lib+'"}}';

  	console.log(this.obj);

  	this.obj = JSON.parse(this.obj);


  	this.ajax.post("wsAutomatico/crearWSDLPHP.php",this.obj).subscribe((resp)=>{

  		this.servicio = resp.url;

  	});
  	console.log(this.obj);
  }
}
