import { Output, EventEmitter, Input, Component, OnInit } from '@angular/core';
import {Character} from '../character'
import {GenderComponent} from './gender.component'

@Component({
  selector: 'app-character',
  templateUrl: './character.component.html'
})
export class CharacterComponent implements OnInit {
  @Input() character: Character
  @Output() hideCharacter = new EventEmitter()

  constructor() { }

  ngOnInit(): void {
  }
  close() {
    this.hideCharacter.emit()
  }
}
