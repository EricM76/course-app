<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Platform;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required | min: 3',
            'description' => 'required | min : 20',
            'link' => 'required'
        ];
        $messages = [
            'title.required' => 'El título del curso es requerido',
            'title.min' => 'El título no puede tener menos que :min caracteres.',
            'description.required' => 'La descripción es requerida.',
            'description.min' => 'La descripción no puede tener menos que :min caracteres.',
            'link.required' => 'El enlace es obligatorio.',

        ];

        $this->validate($request, $rules, $messages);

        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->link = $request->link;
        $course->platform_id = $request->platform;
        $course->save();

        return redirect()->route('courses')->with('success', 'Curso agregado correctamente');
    }

    public function index()
    {
        $courses = Course::all();
        $plataforms = Platform::all();
        return view('courses.index', ['courses' => $courses, 'plataforms' => $plataforms]);
    }

    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show', ['course' => $course]);
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $platforms = Platform::all();

        return view('courses.edit', ['course' => $course, 'platforms' => $platforms]);
    }

    public function update(Request $request, $id)
    {

        //dd($request);

        $rules = [
            'title' => 'required | min: 3',
            'description' => 'required | min : 20',
            'link' => 'required'
        ];
        $messages = [
            'title.required' => 'El título del curso es requerido',
            'title.min' => 'El título no puede tener menos que :min caracteres.',
            'description.required' => 'La descripción es requerida.',
            'description.min' => 'La descripción no puede tener menos que :min caracteres.',
            'link.required' => 'El enlace es obligatorio.',

        ];

        $this->validate($request, $rules, $messages);

        $course = Course::find($id);

        if ($request->hasFile('image')) {
            $date = new DateTime();
            $image = $request->file('image');
            $imageName = Str::slug($request->title) . $date->getTimestamp() . "." . $image->getClientOriginalExtension();
            
            /* 
            $path = public_path('images/logos');
            $image->move($path, $imageName); 
              if(file_exists($path.$course->image)){
                unlink("/images/logos/".$course->image);
            }
            */

            if(Storage::disk('public')->exists($course->image)){
                Storage::disk('public')->delete($course->image);
            }

            $image->storeAs('', $imageName, 'public');
        }


        $course->title = $request->title;
        $course->description = $request->description;
        $course->link = $request->link;
        $course->platform_id = $request->platform;
        $course->image = $imageName;
        $course->save();

        return redirect()->route('courses')->with('success', 'Curso actualizado correctamente');
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('courses')->with('success', 'Curso eliminado con éxito');
    }
}
