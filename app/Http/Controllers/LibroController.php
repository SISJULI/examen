<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $libros = DB::table('libro')
            ->select('id', 'titulo', 'autor', 'numpaginas', 'portada')
            ->where(function ($query) use ($texto) {
                $query->where('titulo', 'LIKE', '%' . $texto . '%')
                    ->orWhere('autor', 'LIKE', '%' . $texto . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('biblioteca.libro.index', compact('libros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biblioteca.libro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'numpaginas' => 'required|numeric',
            'portada' => 'required|image',
        ]);

        // Crear un nuevo objeto Libro con los datos del formulario
        $libro = new Libro();
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->numpaginas = $request->numpaginas;

        if($request->hasFile('portada')){
            $imagen = $request->file('portada');
            $nombreimagen = Str::slug($request->titulo) . '.' . $imagen->guessExtension();
            $ruta = public_path('/img/libros/');
            $imagen->move($ruta, $nombreimagen);
            $libro->portada = $nombreimagen;
        }

        $libro->save();

        // Redireccionar a la página de índice de libros con un mensaje de éxito
        return Redirect::to('biblioteca/libro')->with('success', 'Libro creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('biblioteca.libro.show', ['libro' => Libro::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        return view('biblioteca.libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obtener el libro a actualizar
        $libro = Libro::findOrFail($id);
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->numpaginas = $request->numpaginas;

        if($request->hasFile('portada')){
            $imagen = $request->file('portada');
            $nombreimagen = Str::slug($request->titulo) . '.' . $imagen->guessExtension();
            $ruta = public_path('/img/libros/');
            $imagen->move($ruta, $nombreimagen);
            $libro->portada = $nombreimagen;
        }

        $libro->save();

        // Redireccionar a la página de índice de libros con un mensaje de éxito
        return Redirect::to('biblioteca/libro')->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el libro por su ID
        $libro = Libro::findOrFail($id);

        // Eliminar el libro
        $libro->delete();

        // Redirigir al usuario a la página de listado de libros
        return redirect()->route('libro.index')->with('success', 'Libro eliminado correctamente');
    }
}
