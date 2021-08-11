import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';

import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { NgJsonEditorModule }  from 'ang-jsoneditor'

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    NgJsonEditorModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
