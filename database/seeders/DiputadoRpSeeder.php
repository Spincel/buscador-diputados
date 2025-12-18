<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Diputado;

class DiputadoRpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diputadosRP = [
            ['nombre' => 'Jocelyn Patricia Fernández Molina', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-jocelyn-fernandez-molina', 'type' => 'rp', 'partido' => 'MORENA', 'partido_color' => 'maroon'],
            ['nombre' => 'Irma Magdalena Lora Briseño', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-irma-magdalena-lora-briseno', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'María De La Paz Ramos Heredia', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-maria-de-la-paz-ramos-heredia', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Flavio Obdulio Fonseca Robles', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-flavio-obdulio-fonseca-robles', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Jesús Armando Vélez Macías', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-jesus-armando-velez-macias', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Adriana Elizabeth Haro Oliveros', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-adriana-elizabeth-haro-oliveros', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'José Ramón Cambero Pérez', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-jose-ramon-cambero-perez', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Rodolfo Pedroza Ramírez', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-rodolfo-pedroza-ramirez', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Nadia Alejandra Ramírez López', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-nadia-alejandra-ramirez-lopez', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Francis Paola Vargas Arciniega', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-francis-paola-vargas-arciniega', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Jorge Salvador Álvarez López', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-jorge-salvador-alvarez-lopez', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
            ['nombre' => 'Diego Cristóbal Calderón Estrada', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-diego-cristobal-calderon-estrada', 'type' => 'rp', 'partido' => '', 'partido_color' => ''],
        ];

        foreach ($diputadosRP as $diputado) {
            Diputado::create($diputado);
        }
    }
}
