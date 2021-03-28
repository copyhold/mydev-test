<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\People;
use App\Models\Specie;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // get films
      // get species
      // get people
      //
      $films = file_get_contents("https://swapi.dev/api/films/");
      try {
        $films = json_decode($films, 1, 20, JSON_THROW_ON_ERROR);
      } catch (Exception $e) {
        echo "error while parsing the films source";
        exit(1);
      }
      foreach ($films['results'] as $film) {
        $i = (int)preg_replace('~.*/films/(\\d+)/$~', '$1', $film['url']);
        Film::create([
          'id' => $i,
          'title' => $film['title'],
          'episode_id' => (int)$film['episode_id'],
          'release_date' => $film['release_date'],
        ]);
      }

      $next = "https://swapi.dev/api/species/";
      while ($next) {
        $species = file_get_contents($next);
        try {
          $species = json_decode($species, 1, 20, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
          echo "error while parsing the species source";
          exit(1);
        }
        foreach($species['results'] as $specie) {
          $filmids = array_map(function($film) {
            if (preg_match('~.*/films/(\d+)/$~', $film, $m)) {
              return $m[1];
            }
            return 0;
          }, $specie['films']);
          $i = (int)preg_replace('~.*/species/(\\d+)/$~', '$1', $specie['url']);
          $specie = Specie::create([
            'id'             => $i,
            'name'           => $specie['name'],
            'language'       => $specie['language'],
            'average_height' => (int)filter_var($specie['average_height'], FILTER_SANITIZE_NUMBER_INT),
            'classification' => $specie['classification']
          ]);
          if (!empty($films)) {
            $specie->films()->attach($filmids);
          }
        }
        $next = $species['next'];
      }

      $next = "https://swapi.dev/api/people/";
      while ($next) {
        $people = file_get_contents($next);
        try {
          $people = json_decode($people, 1, 20, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
          echo "error while parsing the people source";
          exit(1);
        }
        foreach($people['results'] as $character) {
          $specieids = array_map(function($spec) {
            if (preg_match('~.*/species/(\d+)/$~', $spec, $m)) {
              return $m[1];
            }
            return 0;
          }, $character['species']);
          $filmids = array_map(function($film) {
            if (preg_match('~.*/films/(\d+)/$~', $film, $m)) {
              return $m[1];
            }
            return 0;
          }, $character['films']);
          $i = (int)preg_replace('~.*/people/(\\d+)/$~', '$1', $character['url']);
          $newchar = People::create([
            'id'         => $i,
            'name'       => $character['name'],
            'skin_color' => $character['skin_color'],
            'eye_color'  => $character['eye_color'],
            'birth_year' => $character['birth_year'],
            'height'     => (int)filter_var($character['height'], FILTER_SANITIZE_NUMBER_INT),
            'mass'       => (int)filter_var($character['mass'], FILTER_SANITIZE_NUMBER_INT),
            'gender'     => $character['gender']
          ]);
          if (!empty($films)) {
            $newchar->films()->attach($filmids);
          }
          if (!empty($specieids)) {
            $newchar->species()->attach($specieids);
          }
        }
        $next = $people['next'];
      }
    }
}
