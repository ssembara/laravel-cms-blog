<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortofolioController extends Controller
{

    public function index()
    {
        $activeCount = Portofolio::active()
            ->count();
        $portofolioCount = Portofolio::count();
        $portofolio = Portofolio::all();

        // Return
        return view('portofolio.index')
            ->with([
                'activeCount' => $activeCount,
                'portofolioCount' => $portofolioCount,
                'portofolio' => $portofolio
            ]);
    }

    public function create()
    {
        // Return
        return view('portofolio.create');
    }

    public function store(Request $request)
    {
        // Validation
        $rules = [
            'image' => 'required|image|max:2048',
            'title' => 'required|min:8|unique:portofolios,title',
            'status' => 'required',
            'description' => 'required|min:10'
        ];
        $rulesMessage = [
            'image.required' => 'Gambar harus dipilih',
            'image.image' => 'Format tidak sesuai',
            'image.max' => 'Ukuran gambar maksimum 2MB',
            'title.required' => 'Judul harus diisi',
            'title.min' => 'Minimal 8 karakter',
            'title.unique' => 'Judul sudah ada',
            'status.required' => 'Status harus dipilih',
            'description.required' => 'Deskripsi harus diisi'
        ];
        $this->validate($request, $rules, $rulesMessage);

        // Declaration
        $image = $request->image;
        $title = $request->title;
        $status = $request->status;
        $description = $request->description;
        $userId = Auth::id();

        // Try-Catch
        DB::beginTransaction();
        try {
            if (!empty($image)) {
                $fileName = $image->getClientOriginalName();
                $fileExtension = $image->getClientOriginalExtension();

                $fileName = str_replace('.' . $fileExtension, '', $fileName);
                $fileName = 'portofolio_' . substr(str_slug($fileName, '-'), 0, 180) . '.' . $fileExtension;
                $file_path = 'uploads/portofolio/';

                $image->move($file_path, $fileName);
            }
            $portofolio = new Portofolio();
            $portofolio->image = $fileName;
            $portofolio->title = $title;
            $portofolio->status = $status;
            $portofolio->description = $description;
            $portofolio->user_id = $userId;
            $portofolio->save();
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
            Log::error($error);
        }

        // Return
        return redirect()
            ->route('portofolio.index')
            ->with('success', 'Portofolio berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $portofolio = Portofolio::find($id);

        if (!$portofolio) {
            return redirect()
                ->back();
        }

        return view('portofolio.edit')
            ->with('portofolio', $portofolio);
    }

    public function update(Request $request, $id)
    {
        // Declaration
        $image = $request->image;
        $title = $request->title;
        $status = $request->status;
        $description = $request->description;
        $userId = Auth::id();

        // Validation
        $rules = [
            'image' => 'image|max:2048',
            'title' => 'required|min:8|unique:portofolios,title,' . $id,
            'status' => 'required',
            'description' => 'required|min:10'
        ];
        $rulesMessage = [
            'image.image' => 'Format tidak sesuai',
            'image.max' => 'Ukuran gambar maksimum 2MB',
            'title.required' => 'Judul harus diisi',
            'title.min' => 'Minimal 8 karakter',
            'title.unique' => 'Judul sudah ada',
            'status.required' => 'Status harus dipilih',
            'description.required' => 'Deskripsi harus diisi'
        ];
        $this->validate($request, $rules, $rulesMessage);

        $portofolio = Portofolio::find($id);

        // Try-Catch
        DB::beginTransaction();
        try {
            if (!empty($image)) {
                $fileName = $image->getClientOriginalName();
                $fileExtension = $image->getClientOriginalExtension();

                $fileName = str_replace('.' . $fileExtension, '', $fileName);
                $fileName = 'portofolio_' . substr(str_slug($fileName, '-'), 0, 180) . '.' . $fileExtension;
                $file_path = 'uploads/portofolio/';

                $upload = $image->move($file_path, $fileName);

                if ($upload) {
                    $oldImage = $portofolio->image;
                    File::delete('uploads/portofolio/' . $oldImage);

                    $portofolio->image = $fileName;
                }
            }

            $portofolio->title = $title;
            $portofolio->status = $status;
            $portofolio->description = $description;
            $portofolio->user_id = $userId;
            $portofolio->save();
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
            Log::error($error);
        }

        // Return
        return redirect()
            ->route('portofolio.index')
            ->with('success', 'Portofolio berhasil diubah');
    }

    public function destroy($id)
    {
        $portofolio = Portofolio::find($id);

        DB::beginTransaction();
        try {
            File::delete('uploads/portofolio/' . $portofolio->image);
            $portofolio->delete();
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
            Log::error($error);
        }

        // Return
        return redirect()
            ->back()
            ->with('success', 'Portofolio berhasil dihapus');
    }
}
