<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = User::where('id', $userId)
            ->first();

        return view('profile.index')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $userId = Auth::id();

        // Validation
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $userId,
            'avatar' => 'image|max:2048  '
        ];
        $rulesMessages = [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak sesuai',
            'email.unique' => 'Email sudah ada',
            'avatar.image' => 'Format avatar tidak sesuai',
            'avatar.max' => 'Avatar maksimum 2MB'
        ];
        $this->validate($request, $rules, $rulesMessages);

        // Declaration
        $name = $request->name;
        $email = $request->email;
        $avatar = $request->avatar;
        $user = User::find($userId);

        // Try-Catch
        DB::beginTransaction();
        try {
            if (!empty($avatar)) {
                $fileName = $avatar->getClientOriginalName();
                $fileExtension = $avatar->getClientOriginalExtension();

                $fileName = str_replace('.' . $fileExtension, '', $fileName);
                $fileName = 'avatar_' . substr(str_slug($fileName, '-'), 0, 180) . '.' . $fileExtension;
                $file_path = 'uploads/user/';

                $upload = $avatar->move($file_path, $fileName);

                if ($upload) {
                    $oldAvatar = $user->avatar;
                    File::delete('uploads/user/' . $oldAvatar);

                    $user->avatar = $fileName;
                }
            }
            $user->name = $name;
            $user->email = $email;
            $user->save();
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
            Log::error($error);
        }

        // Return
        return redirect()
            ->back()
            ->with('success', 'Profil berhasil dirubah');
    }

    public function updatePassword(Request $request)
    {

        // Validation

        $rules = [
            'password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed|different:password',
        ];
        $rulesMessages = [
            'password.required' => 'Sandi lama harus diisi',
            'password.min' => 'Sandi lama minimal 8 karakter',
            'new_password.required' => 'Sandi baru harus diisi',
            'new_password.min' => 'Sandi baru minimal 8 karakter',
            'new_password.confirmed' => 'Sandi baru tidak cocok',
            'new_password.different' => 'Sandi baru harus berbeda'
        ];
        $this->validate($request, $rules, $rulesMessages);

        // Declaration
        $oldPassword = $request->password;
        $newPassword = $request->new_password;
        $userId = Auth::id();
        $user = User::find($userId);

        if (Hash::check($oldPassword, $user->password)) {
            DB::beginTransaction();
            try {
                $user->password = Bcrypt($newPassword);
                $user->save();
                DB::commit();
            } catch (Exception $error) {
                DB::rollback();
                Log::error($error);
            }
            return redirect()
            ->back()
            ->with('success', 'Sandi telah diganti');
        } else {
            return redirect()
            ->back()
            ->with('error', 'Sandi tidak cocok');
        }
    }
}
