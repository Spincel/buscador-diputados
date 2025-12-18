<?php

namespace App\Http\Controllers;

use App\Models\Diputado;
use Illuminate\Http\Request;

class DiputadoController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        $query = Diputado::query();

        if ($type === 'distrito') {
            $query->where('type', 'distrito');
        } elseif ($type === 'rp') {
            $query->where('type', 'rp');
        }

        $diputados = $query->orderBy('distrito')->orderBy('nombre')->get();

        return view('diputados.edit', compact('diputados', 'type'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'diputados.*.nombre' => 'required|string|max:255',
            'diputados.*.enlace' => 'required|string|max:255',
            'diputados.*.partido' => 'nullable|string|max:255',
            'diputados.*.partido_color' => 'nullable|string|max:255',
            'diputados.*.partido_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'diputados.*.secciones' => 'nullable|string',
            'diputados.*.municipios' => 'nullable|string',
            'diputados.*.imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        foreach ($request->diputados as $id => $data) {
            $diputado = Diputado::find($id);
            if ($diputado) {
                $updateData = [
                    'nombre' => $data['nombre'],
                    'enlace' => $data['enlace'],
                    'partido' => $data['partido'],
                    'partido_color' => $data['partido_color'],
                    'secciones' => $data['secciones'],
                    'municipios' => $data['municipios'],
                ];

                if (isset($data['imagen'])) {
                    $imageName = time().'_'.$id.'.'.$data['imagen']->extension();
                    $data['imagen']->move(public_path('images/diputados'), $imageName);
                    $updateData['imagen'] = $imageName;
                }

                if (isset($data['partido_logo'])) {
                    $logoName = time().'_'.$id.'_logo.'.$data['partido_logo']->extension();
                    $data['partido_logo']->move(public_path('images/partidos'), $logoName);
                    $updateData['partido_logo'] = $logoName;
                }

                $diputado->update($updateData);
            }
        }

        return redirect()->route('diputados.edit', ['type' => $request->type])->with('success', 'Información de diputados actualizada correctamente.');
    }

    public function getDiputados()
    {
        return response()->json(Diputado::all());
    }

    public function getDiputadosRp()
    {
        return response()->json(Diputado::where('type', 'rp')->get());
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $diputados = Diputado::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('secciones', 'LIKE', "%{$query}%")
            ->orWhere('municipios', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($diputados);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('file')->getRealPath();
        $records = array_map('str_getcsv', file($path));

        // Skip the header row
        if (count($records) > 0) {
            $header = $records[0];
            $records = array_slice($records, 1);
        }


        foreach ($records as $record) {
            if (count($record) < 6) {
                continue;
            }
            Diputado::updateOrCreate(
                ['distrito' => $record[0]],
                [
                    'nombre' => $record[1],
                    'enlace' => $record[2],
                    'imagen' => $record[3],
                    'secciones' => $record[4],
                    'municipios' => $record[5],
                ]
            );
        }

        return redirect()->route('admin.index')->with('success', 'Diputados importados correctamente.');
    }
}
