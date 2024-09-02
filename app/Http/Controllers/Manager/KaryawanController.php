<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Posisi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        try {
            $data = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->where('roles.nama', 'Karyawan')
                ->with('karyawan')
                ->select('users.*')
                ->get();

            return view('pages.manager.karyawan.index', compact('data'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
        try {
            $posisi = Posisi::all();
            return view('pages.manager.karyawan.create', compact('posisi'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string'],
                'posisi_id' => ['required']
            ]);

            $role = Role::where('nama', 'Karyawan')->first();

            $user = User::create([
                'name' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role_id' => $role->id
            ]);

            $karyawan = Karyawan::create([
                'user_id' => $user->id,
                'posisi_id' => $request->posisi_id
            ]);

            return redirect('/karyawan');
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
            $data = User::with('karyawan')->find($id);
            $posisi = Posisi::all();
            return view('pages.manager.karyawan.edit', compact('data', 'posisi'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'nama' => ['nullable', 'string', 'max:255'],
                'username' => ['nullable', 'string', 'max:255'],
                'password' => ['nullable'],
                'posisi_id' => ['nullable']
            ]);
            
            $user = User::find($id);
            $user->name = $request->nama ?? $user->name;
            $user->username = $request->username ?? $user->username;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            $karyawan = Karyawan::where('user_id', $user->id)->first();
            $karyawan->posisi_id = $request->posisi_id ?? $karyawan->posisi_id;
            $karyawan->save();

            return redirect('/karyawan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            return back()->withErrors($errors)->withInput()->with('error', 'Terjadi kesalahan pada input Anda!');
        } catch (\Exception $e) {
            return back()->with('error', 'Data pegawai gagal ditambahkan! ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id) {
        try {
            $data = User::find($id);
            $data->delete();

            return redirect('/karyawan');
        } catch (\Exception $e) {
            return back()->with('error', 'Data pegawai gagal ditambahkan! ' . $e->getMessage())->withInput();
        }
    }
}
