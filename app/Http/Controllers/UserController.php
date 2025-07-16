<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Alunos; // Importa o model dos alunos

class UserController extends Controller
{
    /**
     * Autenticar professor ou aluno.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1️⃣ Tentativa de login como professor (tabela "users")
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // Painel do professor
        }

        // 2️⃣ Tentativa de login como aluno (tabela "aluno_cadastrado")
        $aluno = Alunos::where('email', $credentials['email'])->first();

        if ($aluno && $aluno->password === $credentials['password']) {
            // Simular login de aluno via sessão
            session(['aluno_id' => $aluno->id]);
            session(['aluno_nome' => $aluno->nome_aluno]);
            return redirect()->intended('dashboard-aluno');
        }

        // 3️⃣ Falha de login
        return back()->with('erro', 'As credenciais informadas são inválidas.');
    }

    /**
     * Logout para professores e alunos.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout(); // logout professor (caso esteja logado)

        // logout aluno (remover da sessão)
        session()->forget(['aluno_id', 'aluno_nome']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Registro de novo professor (usuário da tabela "users").
     */
    public function register(Request $request): RedirectResponse
    {
        $userData = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
