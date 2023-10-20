<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Group;
use App\Models\Level;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Video;
use App\Models\Image;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Models\Phone;
use App\Models\GithubAccount;
use App\Models\Location;
use App\Models\Gender;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Group::factory(3)->create();

        Level::factory()->create(['name' => 'Alumno']);
        Level::factory()->create(['name' => 'Maestro']);
        Level::factory()->create(['name' => 'Rector']);

        Countries::factory()->create(['name' => 'Mexico']);
        Countries::factory()->create(['name' => 'EEUU']);
        Countries::factory()->create(['name' => 'Canada']);

        Gender::factory()->create(['name'=> 'Masculino']);
        Gender::factory()->create(['name'=> 'Femenino']);

        $states=[
            'Aguascalientes',
            'Baja California',
            'Baja California Sur',
            'Campeche',
            'Chiapas',
            'Chihuahua',
            'Ciudad de México',
            'Coahuila',
            'Colima',
            'Durango',
            'Estado de México',
            'Guanajuato',
            'Guerrero',
            'Hidalgo',
            'Jalisco',
            'Michoacán',
            'Morelos',
            'Nayarit',
            'Nuevo León',
            'Oaxaca',
            'Puebla',
            'Querétaro',
            'Quintana Roo',
            'San Luis Potosí',
            'Sinaloa',
            'Sonora',
            'Tabasco',
            'Tamaulipas',
            'Tlaxcala',
            'Veracruz',
            'Yucatán',
            'Zacatecas'
        ];

        foreach ($states as $stateName) {
            States::factory()->create(['name' => $stateName]);
        }
        
        $cities = [
            'Aguascalientes',
            'Jesús María',
            'Tijuana',
            'Mexicali',
            'Ensenada',
            'La Paz',
            'Los Cabos',
            'San José del Cabo',
            'Cabo San Lucas',
            'Ciudad Constitución',
            'Ciudad del Carmen',
            'Campeche',
            'Tuxtla Gutiérrez',
            'San Cristóbal de las Casas',
            'Tapachula',
            'Chihuahua',
            'Ciudad Juárez',
            'Delicias',
            'Saltillo',
            'Torreón',
            'Monclova',
            'Colima',
            'Manzanillo',
            'Durango',
            'Gómez Palacio',
            'Ciudad Lerdo',
            'León',
            'Guanajuato',
            'Irapuato',
            'Acapulco',
            'Chilpancingo',
            'Zihuatanejo',
            'Pachuca',
            'Tulancingo',
            'Tula',
            'Guadalajara',
            'Zapopan',
            'Tlaquepaque',
            'Ciudad de México',
            'Ecatepec',
            'Nezahualcóyotl',
            'Morelia',
            'Uruapan',
            'Zamora',
            'Cuernavaca',
            'Jiutepec',
            'Temixco',
            'Tepic',
            'Bahía de Banderas',
            'Nuevo Vallarta',
            'Monterrey',
            'San Pedro Garza García',
            'Guadalupe',
            'Oaxaca',
            'Salina Cruz',
            'Juchitán',
            'Puebla',
            'Tehuacán',
            'San Andrés Cholula',
            'Querétaro',
            'San Juan del Río',
            'El Marqués',
            'Cancún',
            'Playa del Carmen',
            'Chetumal',
            'San Luis Potosí',
            'Soledad de Graciano Sánchez',
            'Ciudad Valles',
            'Culiacán',
            'Mazatlán',
            'Los Mochis',
            'Hermosillo',
            'Ciudad Obregón',
            'Nogales',
            'Villahermosa',
            'Cárdenas',
            'Comalcalco',
            'Tampico',
            'Ciudad Victoria',
            'Reynosa',
            'Tlaxcala',
            'Apizaco',
            'Veracruz',
            'Xalapa',
            'Coatzacoalcos',
            'Mérida',
            'Valladolid',
            'Progreso',
            'Zacatecas',
            'Fresnillo'
        ];
        
        foreach ($cities as $cityName) {
            Cities::factory()->create(['name' => $cityName]);
        }

        
        User::factory(50)->create()->each(function ($user) {
            $profile = $user->profile()->save(Profile::factory()->make());
            $user->groups()->attach($this->array(rand(1, 3)));
            $user->image()->save(Image::factory()->make(['url' => 'https://lorempixel.com/90/90']));
            $user->phone()->save(Phone::factory()->make());
            $githubAccount = GithubAccount::factory()->create([
                'user_id' => $user->id,
                'username' =>$user->name,
            ]);
            Location::factory()->create();
        });

        Category::factory(4)->create();
        Tag::factory(12)->create();
        Post::factory(40)->create()->each(function ($post) {
            $post->image()->save(Image::factory()->make());
            $post->tags()->attach($this->array(rand(1, 12)));

            $number_comments = rand(1, 6);

            for ($i = 0; $i < $number_comments; $i++) {
                $post->comments()->save(Comment::factory()->make());
            }
        });

        Video::factory(30)->create()->each(function ($video) {
            $video->image()->save(Image::factory()->make());
            $video->tags()->attach($this->array(rand(1, 12)));

            $number_comments = rand(1, 6);

            for ($i = 0; $i < $number_comments; $i++) {
                $video->comments()->save(Comment::factory()->make());
            }
        });
    }

    public function array($max)
    {
        $values = [];
        for ($i = 1; $i < $max; $i++) {
            $values[] = $i;
        }
        return $values;
    }
}