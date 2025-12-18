<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Diputado;

class DiputadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('diputados')->truncate();

        $diputados = [
            ['distrito' => 1, 'nombre' => 'Salvador Castañeda Rangel', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-salvador-castaneda-rangel', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => 'PAN', 'partido_color' => 'blue'],
            ['distrito' => 2, 'nombre' => 'Ricardo Parra Tiznado', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-ricardo-parra-tiznado', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => 'PRI', 'partido_color' => 'red'],
            ['distrito' => 3, 'nombre' => 'María Belén Muñoz Barajas', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-maria-belen-munoz-barajas', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => 'PRD', 'partido_color' => 'yellow'],
            ['distrito' => 4, 'nombre' => 'Marisol Contreras Pérez', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-marisol-contreras-perez', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 5, 'nombre' => 'Juana Nataly Tizcareño Lara', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-juana-nataly-tizcareno-lara', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 6, 'nombre' => 'Jessica Abilene Torres Fregoso', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-jessica-torres-fregoso', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 7, 'nombre' => 'Georgina Guadalupe López Arias', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-georgina-guadalupe-lopez-arias', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 8, 'nombre' => 'Hilda Zulema Montoya García', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-hilda-zulema-montoya-garcia', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 9, 'nombre' => 'Laura Paola Monts Ruiz', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-laura-paola-monts-ruiz', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 10, 'nombre' => 'Luis Enrique Miramontes Vázquez', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-luis-enrique-miramontes-vazquez', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 11, 'nombre' => 'Fabiola María Guadalupe Raudales Rodríguez', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-fabiola-raudales-rodriguez', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 12, 'nombre' => 'Adahan Casas Rivas', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-adahan-casas-rivas', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 13, 'nombre' => 'Marisol Sánchez Navarro', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-marisol-sanchez-navarro', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 14, 'nombre' => 'Luis Daniel Pérez Lerma', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-luis-daniel-perez-lerma', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 15, 'nombre' => 'Rodolfo Gómez Tadeo', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-rodolfo-gomez-tadeo', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 16, 'nombre' => 'Madrid Gwendolyne Vargas Paredes', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-madrid-gwendolyne-vargas-paredes', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 17, 'nombre' => 'José Gómez Pérez', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/partidos/PVEM', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => ''],
            ['distrito' => 18, 'nombre' => 'Carmina Yadira Regalado Mardueño', 'enlace' => 'https://congresonayarit.gob.mx/xxxiv/diputados/dip-carmina-yadira-regalado-mardueno', 'imagen' => '', 'secciones' => '', 'municipios' => '', 'type' => 'distrito', 'partido' => '', 'partido_color' => '']
        ];

        foreach ($diputados as $diputado) {
            Diputado::create($diputado);
        }
    }
}
