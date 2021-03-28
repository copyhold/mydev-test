import { Optional, Inject, Injectable } from '@angular/core';
import {Observable, of} from 'rxjs';
import {FilterParams,Character} from './character';
import {HttpParams,HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CharacterService {

  apibase = 'http://localhost:8000/api/v1'
  constructor(
    private http: HttpClient
  ) { 

  }

  getCharacters(page: number = 1, filter?: {}): Observable<any> {
    const params = new HttpParams({fromObject: filter}).set('page', '' + page)
    return this.http.get<any>(`${this.apibase}/people/`, {params})
  }
  getCharacter(id: number): Observable<any> {
    return this.http.get<Character>(`${this.apibase}/people/${id}/`)
  }
  getStats(): Observable<any> {
    return this.http.get<any>(`${this.apibase}/stats/`)
  }
}
