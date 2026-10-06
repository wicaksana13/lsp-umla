<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ParticipantController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(Request $r)
    {
        $items = User::where('role', 'participant')
            ->when($r->q, function($q, $s){
                $q->where(function($x) use($s){
                    $x->where('name', 'like', "%$s%")
                      ->orWhere('nim', 'like', "%$s%")
                      ->orWhere('email', 'like', "%$s%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('superadmin.peserta.index', compact('items'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('superadmin.peserta.form', [
            'item' => new User()
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $r)
    {
        $data = $this->validateData($r);

        $data['role'] = 'participant';

        // Disimpan sebagai Plain Text (tanpa Hash::make)
        $data['password'] = $r->password;

        if($r->hasFile('photo')){
            $data['photo'] = $r->file('photo')->store('participants', 'public');
        }

        User::create($data);

        return redirect()
            ->route('superadmin.peserta.index')
            ->with('success', 'Akun peserta berhasil dibuat.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $peserta = User::where('role', 'participant')->findOrFail($id);

        return view('superadmin.peserta.form', [
            'item' => $peserta
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $r, $id)
    {
        $peserta = User::where('role', 'participant')->findOrFail($id);

        $data = $this->validateData($r, $peserta->id, true);

        if($r->filled('password')){
            // Disimpan sebagai Plain Text
            $data['password'] = $r->password;
        } else {
            unset($data['password']);
        }

        if($r->hasFile('photo')){
            if($peserta->photo){
                Storage::disk('public')->delete($peserta->photo);
            }
            $data['photo'] = $r->file('photo')->store('participants', 'public');
        }

        $peserta->update($data);

        return redirect()
            ->route('superadmin.peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $peserta = User::where('role', 'participant')->findOrFail($id);

        if($peserta->photo){
            Storage::disk('public')->delete($peserta->photo);
        }

        $peserta->delete();

        return back()->with('success', 'Peserta berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */
    private function validateData(Request $r, $id = null, $edit = false)
    {
        return $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'max:50', Rule::unique('users', 'nim')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'phone' => ['nullable', 'max:30'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password' => [$edit ? 'nullable' : 'required', 'min:6'],
            'is_active' => ['nullable']
        ]) + [
            'is_active' => $r->boolean('is_active')
        ];
    }
}