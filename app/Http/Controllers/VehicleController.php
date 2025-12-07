<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    protected $validationRules;
    protected $attributeNames;
    protected $errorMessages;
    protected $model;

    public function __construct(Vehicle $model)
    {
        $this->validationRules = [
            'marca' => 'required|string|min:2|max:30',
            'modelo' => 'required|string|min:2|max:30',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'precio' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'descripcion' => 'nullable|string|max:500',
            'imagenes' => ['required', 'array', 'min:0', 'max:5'], // max 5 archivos permitidos
            'imagenes.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048' // 2048 KB = 2MB
            ],
        ];

        $this->attributeNames = [
            'marca' => 'marca',
            'modelo' => 'modelo',
            'anio' => 'año',
            'precio' => 'precio',
            'descripcion' => 'descripción',    
        ];

        $this->errorMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'imagenes.max' => 'Solo puedes subir hasta 5 imágenes.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Solo se permiten formatos JPG, JPEG, PNG o WEBP.',
            'imagenes.*.max' => 'Cada imagen debe pesar máximo 2MB.',
        ];

        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('images')->paginate(9);
        return view('vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicle = new Vehicle();

        return view('vehicle.form', compact('vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->setValidator($request)->validate();
        $request->merge([
            'user_id' => auth()->user()->id,
        ]);

        $vehicle = Vehicle::create($request->all());

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('vehicles', 'public');
                $vehicle->images()->create([
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('vehicle.index')->with('success', 'Vehículo guardado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.form', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->setValidator($request, $vehicle->id)->validate();

        $vehicle->update($request->all());

        if ($request->hasFile('imagenes')) {

            // Eliminar imágenes existentes del Storage y DB
            foreach ($vehicle->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            // Subir las nuevas imágenes
            foreach ($request->file('imagenes') as $file) {
                $filePath = $file->store('vehicles', 'public');
                $vehicle->images()->create([
                    'path' => $filePath
                ]);
            }
        }

        return redirect()->route('vehicle.index')->with('success', 'Vehículo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        // Eliminar imágenes del storage
        foreach ($vehicle->images as $img) {
            Storage::delete($img->path); // elimina archivo
            $img->delete(); // elimina registro en DB
        }

        // Eliminar el vehículo
        $vehicle->delete();

        return redirect()
            ->route('vehicle.index')
            ->with('success', 'Vehículo eliminado correctamente.');
    }

    public function qr()
    {
        //
    }

    protected function setValidator(Request $request, $id=0)
    {
        return Validator::make($request->all(), $this->validationRules, $this->errorMessages)->setAttributeNames($this->attributeNames);
    }
}
