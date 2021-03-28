import { NgModule } from '@angular/core';
import { NgxSliderModule } from '@angular-slider/ngx-slider';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { StarWarsComponent } from './star-wars/star-wars.component';
import { CharactersListComponent } from './characters-list/characters-list.component';
import { CharacterComponent } from './character/character.component';
import { CharacterFilterComponent } from './character-filter/character-filter.component';
import { ListNavigationComponent } from './list-navigation/list-navigation.component';

@NgModule({
  declarations: [
    StarWarsComponent,
    CharactersListComponent,
    CharacterComponent,
    CharacterFilterComponent,
    ListNavigationComponent
  ],
  imports: [
    NgxSliderModule,
    FormsModule,ReactiveFormsModule,
    HttpClientModule,
    BrowserModule
  ],
  providers: [],
  bootstrap: [StarWarsComponent]
})
export class AppModule { }
