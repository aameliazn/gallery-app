<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Photo = Photo::get();
        return view('dashboard', [
            'photo' => $Photo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $album = Album::get();
        return view('photo.create', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'image',
            'desc' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('file');

        if (!$file) {
            return redirect()->route('dashboard')->with('success', 'gambar berhasil');
        }

        if (!$file->isValid()) {
            return redirect()->route('dashboard')->with('success', 'gambar berhasil');
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '-' . rand(0, 99) . '.' . $extension;

        $uploadPath = "uploads/gallery/";
        $path = $uploadPath . $filename;

        $file->move($uploadPath, $filename);

        $uploadSuccess = Photo::create([
            'name' => $filename,
            'desc' => $request->desc,
            'path' => $path,
            'userId' => Auth::user()->id,
            'albumId' => $request->albumId,
        ]);

        if ($uploadSuccess) {
            return redirect()->route('dashboard')->with('success', 'gambar berhasil');
        } else {
            return redirect()->route('dashboard')->with('failed', 'gambar gagal');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $photoId)
    {
        $photo = Photo::findOrFail($photoId);

        if (File::exists($photo->path)) {
            File::delete($photo->path);
        }

        $photo->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus');
    }
}
