<?php

namespace App\Http\Controllers;

use App\User;
use App\Option;
use App\Portofolio;
use Exception;
use Illuminate\Http\Request;

class OptionController extends Controller
{

    public function index()
    {
        $greetings = Option::where('name', 'Greetings')
            ->first();

        return view('option.index')
            ->with(['greetings' => $greetings]);
    }

    public function greeting(Request $request, $id)
    {
        $rules = [
            'content' => 'required|min: 3'
        ];

        $ruleMessages = [
            'content.required' => 'Harus diisi',
            'content.min' => 'Minimal 3 karakter'
        ];

        $this->validate($request, $rules, $ruleMessages);

        $content = $request->greeting;
        $greeting = Option::find($id);

        DB::beginTransaction();
        try {
            $greeting->content = $content;
            $greeting->save();
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
            Log::error($error);
        }

        return redirect()
            ->back()
            ->with('succes', 'Greetings berhasil dirubah');
    }

    public function content()
    {
        $user = User::first();
        $portofolios = Portofolio::where('status', 1)
            ->get();

        $greetings = Option::where('name', 'Greetings')
            ->first();

        return view('landing.index')
            ->with([
                'user' => $user,
                'portofolios' => $portofolios,
                'greetings' => $greetings
            ]);
    }
}
