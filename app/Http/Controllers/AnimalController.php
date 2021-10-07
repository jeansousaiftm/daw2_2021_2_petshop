<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Especie;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal = new Animal();
		$animais = DB::table("animal AS a")
						->join("especie AS e", "a.especie", "=", "e.id")
						->select("a.id", "a.nome", "a.idade", "e.nome AS especie")
						->get();
		$especies = Especie::All();
        return view("animal.index", [
			"animal" => $animal,
			"animais" => $animais,
			"especies" => $especies
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$animal = Animal::Find($request->get("id"));
		} else {
			$animal = new Animal();
		}
		$animal->nome = $request->get("nome");
		$animal->dono = $request->get("dono");
		$animal->especie = $request->get("especie");
		$animal->raca = $request->get("raca");
		$animal->nascimento = $request->get("nascimento");
		
		$hoje = \Carbon\Carbon::now();
		$nascimento = \Carbon\Carbon::Parse($animal->nascimento);

		$animal->idade = $hoje->diffInYears($nascimento);
		
		$animal->Save();
		$request->Session()->Flash("status", "salvo");
		return redirect("/animal");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Animal::Find($id);
		$animais = DB::table("animal AS a")
						->join("especie AS e", "a.especie", "=", "e.id")
						->select("a.id", "a.nome", "a.idade", "e.nome AS especie")
						->get();
		$especies = Especie::All();
        return view("animal.index", [
			"animal" => $animal,
			"animais" => $animais,
			"especies" => $especies
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Animal::Destroy($id);
		$request->Session()->Flash("status", "excluido");
		return redirect("/animal");
    }
}
