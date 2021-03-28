import { Component, OnInit } from '@angular/core';
import {CharacterService} from '../character.service';
import {FilterParams,Character} from '../character';

@Component({
  selector: 'app-star-wars',
  templateUrl: './star-wars.component.html',
  styleUrls: ['./star-wars.component.css']
})
export class StarWarsComponent implements OnInit {
  characters: Character[] = []
  character: Character = null
  page: number = 1
  links: any = {}
  meta: any = {}
  filter_params: FilterParams = {}

  constructor(private characterService: CharacterService) { }
  getCharacters(): void {
    this.characterService.getCharacters(this.page, this.filter_params)
    .subscribe(data => {
      this.characters = data.data
      this.links      = data.links
      this.meta       = data.meta
    })
  }
  ngOnInit(): void {
    this.getCharacters()
  }
  showCharacter(character) {
    this.characterService.getCharacter(character.id)
    .subscribe(data => {
      this.character = data.data
    })
  }
  hideCharacter() {
    this.character = null
  }
  filter(params:FilterParams) {
    this.page = 1
    this.filter_params = params
    this.getCharacters()
  }
  navigate(link) {
    const url = new URL(link)
    this.page = parseInt(url.searchParams.get('page')) || 1
    this.getCharacters()
  }
}
