<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $platforms = Platform::all();

        return view('platforms.index', ['platforms' => $platforms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required | min: 3',
            'description' => 'required | min : 20',
            'link' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre de la plataforma es requerida',
            'name.min' => 'El nombre no puede tener menos que :min caracteres.',
            'description.required' => 'La descripción es requerida.',
            'description.min' => 'La descripción no puede tener menos que :min caracteres.',
            'link.required' => 'El enlace es obligatorio.',

        ];
        $this->validate($request, $rules, $messages);
        $plataform = new Platform;
        $plataform->name = $request->name;
        $plataform->description = $request->description;
        $plataform->link = $request->link;

        $plataform->save();

        return redirect()->route('platforms.index')->with('success', 'Plataforma agregada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $platform = Platform::find($id);
        return view('platforms.show', ['platform' => $platform]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $platform = Platform::find($id);
        return view('platforms.edit', ['platform' => $platform]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name' => 'required | min: 3',
            'description' => 'required | min : 20',
            'link' => 'required'
        ];
        $messages = [
            'name.required' => 'El nombre de la plataforma es requerida',
            'name.min' => 'El nombre no puede tener menos que :min caracteres.',
            'description.required' => 'La descripción es requerida.',
            'description.min' => 'La descripción no puede tener menos que :min caracteres.',
            'link.required' => 'El enlace es obligatorio.',

        ];
        $this->validate($request, $rules, $messages);

        $plataform = Platform::find($id);

        if ($request->hasFile('image')) {
            $date = new DateTime();
            $image = $request->file('image');
            $imageName = Str::slug($request->name) . $date->getTimestamp() . "." . $image->getClientOriginalExtension();

            if (Storage::disk('public')->exists($plataform->image)) {
                Storage::disk('public')->delete($plataform->image);
            }

            $image->storeAs('', $imageName, 'public');
        }

        $plataform->name = $request->name;
        $plataform->description = $request->description;
        $plataform->link = $request->link;
        $plataform->image = $imageName;

        $plataform->save();

        return redirect()->route('platforms.index')->with('success', 'Plataforma actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $platform = Platform::find($id);
        $platform->courses()->each(function ($course) {
            $course->delete();
        });
        $platform->delete();

        return redirect()->route('platforms.index')->with('success', $platform->name . ' fue eliminada con éxito');
    }
}
