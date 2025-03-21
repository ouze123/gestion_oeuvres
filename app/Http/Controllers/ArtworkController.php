<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    /**
     * Affiche la liste des œuvres.
     */
    public function index()
    {
        $artworks = Artwork::with('category')->get();
        return view('artworks.index', compact('artworks'));
    }

    /**
     * Affiche le formulaire de création d'une œuvre.
     */
    public function create()
    {
        $categories = Category::all();
        return view('artworks.create', compact('categories'));
    }

    /**
     * Enregistre une nouvelle œuvre.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'year' => 'required|integer',
            'acquisition_date' => 'required|date',
            'estimated_price' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        // Gestion de l'upload de la photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artworks', 'public');
        }

        Artwork::create($data);

        return redirect()->route('artworks.index')
                         ->with('success', 'Œuvre ajoutée avec succès.');
    }

    /**
     * Affiche les détails d'une œuvre.
     */
    public function show(Artwork $artwork)
    {
        return view('artworks.show', compact('artwork'));
    }

    /**
     * Affiche le formulaire de modification d'une œuvre.
     */
    public function edit(Artwork $artwork)
    {
        $categories = Category::all();
        return view('artworks.edit', compact('artwork', 'categories'));
    }

    /**
     * Met à jour une œuvre existante.
     */
    public function update(Request $request, Artwork $artwork)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'year' => 'required|integer',
            'acquisition_date' => 'required|date',
            'estimated_price' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        // Gestion de l'upload de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($artwork->photo) {
                Storage::disk('public')->delete($artwork->photo);
            }
            $data['photo'] = $request->file('photo')->store('artworks', 'public');
        }

        $artwork->update($data);

        return redirect()->route('artworks.index')
                         ->with('success', 'Œuvre mise à jour avec succès.');
    }

    /**
     * Supprime une œuvre.
     */
    public function destroy(Artwork $artwork)
    {
        // Supprimer la photo associée si elle existe
        if ($artwork->photo) {
            Storage::disk('public')->delete($artwork->photo);
        }

        $artwork->delete();

        return redirect()->route('artworks.index')
                         ->with('success', 'Œuvre supprimée avec succès.');
    }
}