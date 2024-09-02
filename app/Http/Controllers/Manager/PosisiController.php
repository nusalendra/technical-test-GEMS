<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Posisi;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function index()
    {
        $data = Posisi::all();
        return view('pages.manager.posisi.index', compact('data'));
    }

    public function create()
    {
        try {
            return view('pages.manager.posisi.create');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => ['required', 'string', 'max:255'],
            ]);

            Posisi::create([
                'nama' => $request->nama
            ]);

            return redirect('/posisi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return back()->withErrors($errors)->withInput()->with('error', 'Terjadi kesalahan pada input Anda!');
        } catch (\Exception $e) {
            return back()->with('error', 'Data pegawai gagal ditambahkan! ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $data = Posisi::find($id);
            return view('pages.manager.posisi.edit', compact('data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => ['string', 'max:255'],
            ]);

            $posisi = Posisi::find($id);
            $posisi->nama = $request->nama ?? $posisi->nama;
            $posisi->save();

            return redirect('/posisi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return back()->withErrors($errors)->withInput()->with('error', 'Terjadi kesalahan pada input Anda!');
        } catch (\Exception $e) {
            return back()->with('error', 'Data pegawai gagal ditambahkan! ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $data = Posisi::find($id);
            $data->delete();

            return redirect('/posisi');
        } catch (\Exception $e) {
            return back()->with('error', 'Data pegawai gagal ditambahkan! ' . $e->getMessage())->withInput();
        }
    }
}
