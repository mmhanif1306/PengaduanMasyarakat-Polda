<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\CreateRequest;
use App\Http\Requests\Auth\UpdateRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('inventaris'); // Redirect ke halaman inventaris
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        
        $user = new user();
        $user->nik = $data['nik'];
        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'user'; // Atur role default sebagai user
        $user->save();
        if (!$user) {
            return redirect()->back()->with('error', 'Gagal membuat user');
        }

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $user->id;
        $notifikasi->judul = "Registrasi berhasil";
        $notifikasi->deskripsi = "Registrasi berhasil dengan email " . $user->email . " atas nama " . $user->nama;
        $notifikasi->save();

        // Login user setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard dengan pesan
        return redirect()->route('inventaris')
            ->with('success', 'Registrasi berhasil!');
    }

    // public function forgotPassword()
    // {
    //     return view('auth.forgot-password');
    // }

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     $user = User::where('email', $request->email)->first();
    //     $user->update([
    //         'password' => Hash::make($request->password)
    //     ]);

    //     return redirect()->route('login.page')
    //         ->with('status', 'Password berhasil direset! Silakan login dengan password baru.');
    // }

    public function profile()
    {
        return view('auth.profile');
    }

    public function showProfile()
    {
        $user = User::where('id', Auth::id())->first();
        return response()->json($user);
    }

    public function updateProfile(UpdateRequest $request)
    {
        $data = $request->validated();
        $user = User::where('id', Auth::id())->first();
        if ($request->hasFile('image')) {
            $image = cloudinary()->uploadApi()->upload($data['image']->getRealPath(), [
                'folder' => 'profile',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                    'compression' => 'low',
                ],
            ]);
            if (!$image) {
                return redirect()->back()->with('error', 'Gagal mengunggah gambar');
            }
            $oldImage = $user->public_id;
            $user->public_id = $image['public_id'];
            $user->url_file = $image['secure_url'];
        } else {
            $oldImage = null;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($data['password']);
        }
        if ($request->has('email')) {
            $user->email = $data['email'];
        }
        $user->save();
        if (!$user) {
            if ($image) {
                cloudinary()->uploadApi()->destroy($image['public_id']);
            }
            return redirect()->back()->with('error', 'Gagal mengupdate profile');
        }
        if ($oldImage) {
            cloudinary()->uploadApi()->destroy($oldImage);
        }

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $user->id;
        $notifikasi->judul = "Profile berhasil diupdate";
        $notifikasi->deskripsi = "Profile berhasil diupdate dengan email " . $user->email . " dan nama " . $user->nama;
        $notifikasi->save();
        
        return redirect()->route('profile')->with('success', 'Profile berhasil diupdate');
    }
}