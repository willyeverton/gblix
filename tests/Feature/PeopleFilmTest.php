<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\People;
use App\Models\PeopleFilm as PeopleFilmModel;
use App\Services\Facades\PeopleFilm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PeopleFilmTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSaveResponseCrawlerGhibli()
    {
        $data = [
            "films" => json_decode('
                [{
                    "id": "58611129-2dbc-4a81-a72f-77ddfc1b1b49",
                    "title": "My Neighbor Totoro",
                    "description": "Two sisters move to the country with their father in order to be closer to their hospitalized mother, and discover the surrounding trees are inhabited by Totoros, magical spirits of the forest. When the youngest runs away from home, the older sister seeks help from the spirits to find her.",
                    "director": "Hayao Miyazaki",
                    "producer": "Hayao Miyazaki",
                    "release_date": "1988",
                    "rt_score": "93",
                    "people": [
                        "https://ghibliapi.herokuapp.com/people/986faac6-67e3-4fb8-a9ee-bad077c2e7fe",
                        "https://ghibliapi.herokuapp.com/people/d5df3c04-f355-4038-833c-83bd3502b6b9",
                        "https://ghibliapi.herokuapp.com/people/3031caa8-eb1a-41c6-ab93-dd091b541e11",
                        "https://ghibliapi.herokuapp.com/people/87b68b97-3774-495b-bf80-495a5f3e672d",
                        "https://ghibliapi.herokuapp.com/people/d39deecb-2bd0-4770-8b45-485f26e1381f",
                        "https://ghibliapi.herokuapp.com/people/591524bc-04fe-4e60-8d61-2425e42ffb2a",
                        "https://ghibliapi.herokuapp.com/people/c491755a-407d-4d6e-b58a-240ec78b5061",
                        "https://ghibliapi.herokuapp.com/people/f467e18e-3694-409f-bdb3-be891ade1106",
                        "https://ghibliapi.herokuapp.com/people/08ffbce4-7f94-476a-95bc-76d3c3969c19",
                        "https://ghibliapi.herokuapp.com/people/0f8ef701-b4c7-4f15-bd15-368c7fe38d0a"
                    ],
                    "species": [
                        "https://ghibliapi.herokuapp.com/species/af3910a6-429f-4c74-9ad5-dfe1c4aa04f2",
                        "https://ghibliapi.herokuapp.com/species/603428ba-8a86-4b0b-a9f1-65df6abef3d3",
                        "https://ghibliapi.herokuapp.com/species/74b7f547-1577-4430-806c-c358c8b6bcf5"
                    ],
                    "locations": [
                        "https://ghibliapi.herokuapp.com/locations/"
                    ],
                    "vehicles": [
                        "https://ghibliapi.herokuapp.com/vehicles/"
                    ],
                    "url": "https://ghibliapi.herokuapp.com/films/58611129-2dbc-4a81-a72f-77ddfc1b1b49"
                },
                {
                    "id": "ea660b10-85c4-4ae3-8a5f-41cea3648e3e",
                    "title": "Kiki\'s Delivery Service",
                    "description": "A young witch, on her mandatory year of independent life, finds fitting into a new community difficult while she supports herself by running an air courier service.",
                    "director": "Hayao Miyazaki",
                    "producer": "Hayao Miyazaki",
                    "release_date": "1989",
                    "rt_score": "96",
                    "people": [
                        "https://ghibliapi.herokuapp.com/people/"
                    ],
                    "species": [
                        "https://ghibliapi.herokuapp.com/species/af3910a6-429f-4c74-9ad5-dfe1c4aa04f2"
                    ],
                    "locations": [
                        "https://ghibliapi.herokuapp.com/locations/"
                    ],
                    "vehicles": [
                        "https://ghibliapi.herokuapp.com/vehicles/"
                    ],
                    "url": "https://ghibliapi.herokuapp.com/films/ea660b10-85c4-4ae3-8a5f-41cea3648e3e"
                }]', true),
            'people'=> json_decode('
                [{
                    "id": "986faac6-67e3-4fb8-a9ee-bad077c2e7fe",
                    "name": "Satsuki Kusakabe",
                    "gender": "Female",
                    "age": "11",
                    "eye_color": "Dark Brown/Black",
                    "hair_color": "Dark Brown",
                    "films": [
                        "https://ghibliapi.herokuapp.com/films/58611129-2dbc-4a81-a72f-77ddfc1b1b49"
                    ],
                    "species": "https://ghibliapi.herokuapp.com/species/af3910a6-429f-4c74-9ad5-dfe1c4aa04f2",
                    "url": "https://ghibliapi.herokuapp.com/people/986faac6-67e3-4fb8-a9ee-bad077c2e7fe"
                },
                {
                    "id": "d5df3c04-f355-4038-833c-83bd3502b6b9",
                    "name": "Mei Kusakabe",
                    "gender": "Female",
                    "age": "4",
                    "eye_color": "Brown",
                    "hair_color": "Light Brown",
                    "films": [
                        "https://ghibliapi.herokuapp.com/films/58611129-2dbc-4a81-a72f-77ddfc1b1b49"
                    ],
                    "species": "https://ghibliapi.herokuapp.com/species/af3910a6-429f-4c74-9ad5-dfe1c4aa04f2",
                    "url": "https://ghibliapi.herokuapp.com/people/d5df3c04-f355-4038-833c-83bd3502b6b9"
                }]', true),
        ];

        PeopleFilm::save($data);

        $this->assertDatabaseHas('films', [
            'title' => 'My Neighbor Totoro',
        ]);
    }

    public function testRequestGetPeopleMyApi()
    {
        PeopleFilmModel::factory()
            ->has(People::factory()->count(3))
            ->has(Film::factory()->count(3))
            ->count(3)
            ->create();

        $response = $this->get('/api/people?fmt=json&order=name&sort=desc');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'SUCCESS',
            ]);
    }
}
