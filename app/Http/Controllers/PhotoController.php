<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $uploadPath = "uploads/gallery/";

            $file = $request->file('file');

            $extention = $file->getClientOriginalExtension();
            $filename = time() . '-' . rand(0, 99) . '.' . $extention;

            $file->move($uploadPath, $filename);

            $path = $uploadPath . $filename;

            Photo::create([
                'name' => $filename,
                'desc' => $request->desc,
                'path' => $path,
                'userId' => Auth::user()->id,
            ]);

            return response()->json(['success' => 'Image Uploaded Successfully']);
        } else {
            return response()->json(['error' => 'File upload failed.']);
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
