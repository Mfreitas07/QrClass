<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkPlataforma;

class LinkPlataformaController extends Controller
{
    public function showForm()
    {
        $link = LinkPlataforma::latest()->first();
        return view('professorlink', compact('link'));
    }

    public function salvar(Request $request)
{
    $request->validate([
        'link' => 'required|url'
    ]);

    // Apaga links antigos
    LinkPlataforma::truncate();

    // Salva novo link com professor logado
    LinkPlataforma::create([
        'link' => $request->link,
        'professor_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Link salvo com sucesso!');
}
}