import { Input, Component, Output, EventEmitter, OnInit } from '@angular/core';

@Component({
  selector: 'app-list-navigation',
  templateUrl: './list-navigation.component.html'
})
export class ListNavigationComponent implements OnInit {
  @Output() onNavigate = new EventEmitter<string>()
  @Input() links: any
  @Input() meta: any

  navigate(link) {
    this.onNavigate.emit(link.url)
  }

  constructor() { }

  ngOnInit(): void {
  }

}
