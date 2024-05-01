<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registro = new Libro();

        $registro->usuario = "admin";
        $registro->titulo = "El hobbit";
        $registro->autor = "J. R. R. Tolkien";
        $registro->publicacion = "21-09-1937";
        $registro->genero = "Fantasia heroica";
        $registro->descripcion = "Bilbo Bolsón, tras la llegada del mago Gandalf y un grupo de enanos a su casa en Bolsón Cerrado, emprende un viaje para expulsar a Smaug de la Montaña Solitaria.";
        $registro->portada = "elhobbit.jpg";
        $registro->finalizado = true;

        $registro->save();

        $registro2 = new Libro();

        $registro2->usuario = "facu";
        $registro2->titulo = "Alicia en el país de las maravillas";
        $registro2->autor = "Lewis Carroll";
        $registro2->publicacion = "26-11-1865";
        $registro2->genero = "Fantasía";
        $registro2->descripcion = "Alicia, una joven curiosa y aventurera, cae por la madriguera de un conejo y se encuentra en un mundo fantástico y desconcertante. Este país de maravillas está habitado por personajes bizarros como el Conejo Blanco, el Sombrerero Loco, la Reina de Corazones, y el Gato de Cheshire, entre otros. A lo largo de su viaje, Alicia enfrenta una serie de desafíos y acertijos, que desafían su lógica y su percepción de la realidad. El País de las Maravillas es un lugar donde las reglas convencionales del tiempo, el espacio y la lógica no aplican, llevando a Alicia (y al lector) a cuestionar constantemente lo que se da por sentado en el mundo real.";
        $registro2->portada = "Alici_En_El_Pais_De.jpg";
        $registro2->finalizado = false;

        $registro2->save();

        $registro3 = new Libro();

        $registro3->usuario = "johndoe";
        $registro3->titulo = "Eso";
        $registro3->autor = "Stephen King";
        $registro3->publicacion = "15-09-1986";
        $registro3->genero = "Terror";
        $registro3->descripcion = "¿Quién o qué mutila y mata a los niños de un pequeño pueblo norteamericano? ¿Por qué llega cíclicamente el horror a Derry en forma de un payaso siniestro que va sembrando la destrucción a su paso? Esto es lo que se proponen averiguar los protagonistas de esta novela.";
        $registro3->portada = "eso.jpg";
        $registro3->finalizado = true;

        $registro3->save();

        $registro4 = new Libro();

        $registro4->usuario = "facu";
        $registro4->titulo = "Don Quijote de la Mancha";
        $registro4->autor = "Miguel de Cervantes";
        $registro4->publicacion = "16-01-1605";
        $registro4->genero = "Aventura, parodia";
        $registro4->descripcion = "Esta obra maestra de la literatura española sigue las aventuras de un hidalgo enloquecido que se cree caballero andante, y su fiel escudero, Sancho Panza. A través de sus desventuras cómicas y conmovedoras, Cervantes ofrece una sátira de la sociedad española de la época, explorando temas de idealismo, locura y realidad.";
        $registro4->portada = "donquijote.jpg";
        $registro4->finalizado = false;

        $registro4->save();

        $registro5 = new Libro();

        $registro5->usuario = "admin";
        $registro5->titulo = "Moby Dick";
        $registro5->autor = "Herman Melville";
        $registro5->publicacion = "18-10-1851";
        $registro5->genero = "Ficción náutica";
        $registro5->descripcion = "A bordo del ballenero Pequod, el obsesionado capitán Ahab lidera una persecución épica tras la legendaria ballena blanca, Moby Dick. A través de esta aventura marítima, Melville explora temas de obsesión, venganza y la lucha del hombre contra la naturaleza, creando una obra que trasciende géneros y épocas.";
        $registro5->portada = "mobydick.webp";
        $registro5->finalizado = true;

        $registro5->save();
    }
}
