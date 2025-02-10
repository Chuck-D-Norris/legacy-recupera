<?php

namespace App\Controllers\Admin;

use App\Core\Session;
use App\Core\View;
use App\Models\Pokemon;

class PokemonController
{
    public function index($queryParams)
    {
        $pokemons = Pokemon::findAll();
        View::render([
            'view' => 'Admin/Pokemons',
            'title' => 'Pokemons',
            'layout' => 'Admin/AdminLayout',
            'data' => ['pokemons' => $pokemons],
        ]);
    }

    public function create($queryParams)
    {
        View::render([
            'view' => 'Admin/Pokemon/Create',
            'title' => 'Nuevo Pokémon',
            'layout' => 'Admin/AdminLayout',
        ]);
    }

    public function store($postData)
    {
        $pokemon = new Pokemon();

        $pokemon->name = $postData['name'] ?? null;
        $pokemon->type = $postData['type'] ?? null;
        $pokemon->points = 0; 

        $pokemon->save();
        
        
        if ($pokemon->getId()) {
            Session::set('success', 'Pokémon creado correctamente');
            header('Location: /admin/pokemon');
            exit;
        } else {
            Session::set('error', 'Error al crear el Pokémon');
            header('Location: /admin/pokemon/create');
            exit;
        }
    }

    public function edit($id, $queryParams)
    {
        $pokemon = Pokemon::find($id);

        if (! $pokemon) {
            Session::set('error', 'Pokémon no encontrado');
            header('Location: /admin/pokemon');
            exit;
        }

        View::render([
            'view' => 'Admin/Pokemon/Edit',
            'title' => 'Editando Pokémon',
            'layout' => 'Admin/AdminLayout',
            'data' => ['pokemon' => $pokemon],
        ]);
    }

    public function update($id, $postData)
    {
        $pokemon = Pokemon::find($id);

        if ($pokemon) {
            $pokemon->name = $postData['name'] ?? $pokemon->name;
            $pokemon->type = $postData['type'] ?? $pokemon->type;
            $pokemon->puntos = $postData['puntos'] ?? $pokemon->puntos;
            
            $pokemon->save();
            
            Session::set('success', 'Pokémon actualizado correctamente');
        } else {
            Session::set('error', 'Pokémon no encontrado');
        }

        header('Location: /admin/pokemon');
        exit;
    }

    public function destroy($id, $queryParams)
    {
        $pokemon = Pokemon::find($id);

        if ($pokemon) {
            $pokemon->delete();
            Session::set('success', 'Pokémon eliminado correctamente');
        } else {
            Session::set('error', 'Pokémon no encontrado');
        }

        header('Location: /admin/pokemon');
        exit;
    }

    public function points($id, $postData)
    {
        $pokemon = Pokemon::find($id);

        if ($pokemon) {
            $action = $postData['action'] ?? '';
            if ($action === 'increment') {
                $pokemon->points += 1;
            } elseif ($action === 'decrement' && $pokemon->points > 0) {
                $pokemon->points -= 1;
            }
            $pokemon->save();
            Session::set('success', 'Puntos actualizados correctamente');
        } else {
            Session::set('error', 'Pokémon no encontrado');
        }

        header('Location: /admin/pokemon');
        exit;
    }

    public function convert($queryParams)
    {
        $pokemons = Pokemon::findAll();
        View::render([
            'view' => 'Admin/Pokemon/Convert',
            'title' => 'Convertir Puntos',
            'layout' => 'Admin/AdminLayout',
            'data' => ['pokemons' => $pokemons],
        ]);
    }

    public function intercanvis($postData)
    {
        $pokemonFrom = Pokemon::find($postData['pokemon']);
        $pokemonTo = Pokemon::find($postData['pokemon2']);
        $points = (int) $postData['points'];

        if ($pokemonFrom && $pokemonTo && $points > 0 && $pokemonFrom->points >= $points) {
            $pokemonFrom->points -= $points;
            $pokemonTo->points += $points;

            $pokemonFrom->save();
            $pokemonTo->save();

            Session::set('success', 'Puntos transferidos correctamente');
        } else {
            Session::set('error', 'Error al transferir los puntos');
        }

        header('Location: /admin/pokemon');
        exit;
    }
}
