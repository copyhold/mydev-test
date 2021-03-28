import {Output,Input,Component,EventEmitter} from '@angular/core'
import { Options } from '@angular-slider/ngx-slider';
import {FilterParams,Character} from '../character'
import {FormGroup,FormControl} from '@angular/forms'
import {CharacterService} from '../character.service'

@Component({
  selector: 'app-character-filter',
  templateUrl: './character-filter.component.html'
})

export class CharacterFilterComponent {
  @Input() characters: Character[] = []
  @Output() onFilter = new EventEmitter<FilterParams>()
  constructor(private characterService: CharacterService) { }

  stats: any = {}
  filters: FilterParams
  form = new FormGroup({
    name: new FormControl(''),
    gender: new FormControl(''),
    eye_color: new FormControl(''),
    skin_color: new FormControl(''),
    'heights[]': new FormControl([0,999])
  })

  heights_options: Options = {
    floor: 0,
    ceil: 1000,
    step: 10
  }

  reset() {
    this.form.reset()
    this.onFilter.emit(this.form.value)
  }
  filter() {
    this.onFilter.emit(this.form.value)
  }
  getStats(): void {
    this.characterService.getStats()
    .subscribe(data => {
      this.stats = data
      this.heights_options = {
        floor: data.minheight,
        ceil: data.maxheight
      }
    })
  }
  ngOnInit(): void {
    this.getStats()
  }

}
