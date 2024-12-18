<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Asegúrate de importar Log

class ActivityController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        // URL base de la API (configurada en el archivo .env)
        $this->baseUrl = env('ACTIVITIES_API_URL');
    }

    // Listar actividades
    public function index()
    {
        try {
            // Agregar la API Key en los encabezados
            $response = Http::withHeaders([
                'x-api-key' => 'UquVatPYGC5xUwUO7bVFt3vSTR7vyH5p9VmTSD78' // API Key aquí
            ])->get("{$this->baseUrl}/activities");

            if ($response->successful()) {
                $activities = $response->json();
                return view('activities.index', compact('activities'));
            }

            return back()->withErrors('Error al obtener las actividades.');
        } catch (\Exception $e) {
            return back()->withErrors('Ocurrió un problema al conectarse con la API.');
        }
    }

    // Formulario para crear actividad
    public function create()
    {
        return view('activities.create');
    }

    // Guardar nueva actividad
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'reservationDate' => 'required|date',
            'totalCapacity' => 'required|integer|min:1',
            'availableCapacity' => 'required|integer|min:0',
        ]);

        try {
            $response = Http::withHeaders([
                'x-api-key' => 'UquVatPYGC5xUwUO7bVFt3vSTR7vyH5p9VmTSD78'
            ])->post("{$this->baseUrl}/activities", $data);

            if ($response->successful()) {
                return redirect()->route('activities.index')->with('success', 'Actividad creada exitosamente.');
            }

            // En caso de error, muestra el cuerpo de la respuesta para más detalles
            Log::error("Error al crear la actividad: ", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return back()->withErrors('Error al crear la actividad.')->withInput();
        } catch (\Exception $e) {
            Log::error("No se pudo conectar con la API: ", ['message' => $e->getMessage()]);
            return back()->withErrors('No se pudo conectar con la API.')->withInput();
        }
    }

    // Formulario para editar actividad
    public function edit($id)
    {
        try {
            // Agregar la API Key en los encabezados
            $response = Http::withHeaders([
                'x-api-key' => 'UquVatPYGC5xUwUO7bVFt3vSTR7vyH5p9VmTSD78'
            ])->get("{$this->baseUrl}/activities/{$id}");

            // Verificamos si la respuesta fue exitosa
            if ($response->successful()) {
                $activity = $response->json();

                return view('activities.edit', compact('activity'));
            } else {
                // Si la respuesta no fue exitosa, mostramos el mensaje de error detallado
                Log::error("Error al obtener la actividad: ", [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return back()->withErrors('Error al obtener la información de la actividad.');
            }
        } catch (\Exception $e) {
            Log::error("Error al conectar con la API: ", ['message' => $e->getMessage()]);
            return back()->withErrors('No se pudo conectar con la API.');
        }
    }

    // Actualizar actividad
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'reservationDate' => 'required|date',
            'totalCapacity' => 'required|integer|min:1',
            'availableCapacity' => 'required|integer|min:0',
        ]);

        try {
            // Agregar la API Key en los encabezados
            $response = Http::withHeaders([
                'x-api-key' => 'UquVatPYGC5xUwUO7bVFt3vSTR7vyH5p9VmTSD78' // API Key aquí
            ])->put("{$this->baseUrl}/activities/{$id}", $data);

            if ($response->successful()) {
                return redirect()->route('activities.index')->with('success', 'Actividad actualizada exitosamente.');
            }

            return back()->withErrors('Error al actualizar la actividad.')->withInput();
        } catch (\Exception $e) {
            return back()->withErrors('No se pudo conectar con la API.')->withInput();
        }
    }

    // Eliminar actividad
    public function destroy($id)
    {
        try {
            // Agregar la API Key en los encabezados
            $response = Http::withHeaders([
                'x-api-key' => 'UquVatPYGC5xUwUO7bVFt3vSTR7vyH5p9VmTSD78' // API Key aquí
            ])->delete("{$this->baseUrl}/activities/{$id}");

            if ($response->successful()) {
                return redirect()->route('activities.index')->with('success', 'Actividad eliminada correctamente.');
            }

            return back()->withErrors('Error al eliminar la actividad.');
        } catch (\Exception $e) {
            return back()->withErrors('No se pudo conectar con la API.');
        }
    }
}
