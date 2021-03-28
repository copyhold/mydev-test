export interface FilterParams {
  name?: string,
  eyecolor?: string,
  minheight?: number,
  maxheight?: number
}
export interface Film {
  id: number,
  title: string,
  episode_id: number,
  release_date: Date
}
export interface Specie {
  id: number,
  name: string,
  language: string,
  avarage_height: number,
  classification: string
}
export interface Character {
  id: number,
  name: string,
  skin_color: string,
  eye_color: string,
  birth_year: string,
  height: number,
  mass: number,
  gender: string
  species: Specie[],
  films: Film[],
}
