import { Output, EventEmitter, Input, Component, OnInit } from '@angular/core';
import {Character} from '../character';

@Component({
  selector: 'app-characters-list',
  templateUrl: './characters-list.component.html',
  styleUrls: ['./characters-list.component.css']
})
export class CharactersListComponent implements OnInit {

  @Input() characters: Character[];
  @Output() showCharacter = new EventEmitter<Character>();

  constructor() { }

  show(character) {
    this.showCharacter.emit(character)
  }
  ngOnInit(): void {
  }

}
