<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::All();
        return view('photos.index', ['photos'=>$photos]);
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'required',
        ]);

        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /photos
            $request->file->store('photo', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $photo = new Photo([
                "name" => $request->get('name'),
                "country" => $request->get('country'),
                "image" => $request->file->hashName(),
                "description" => $request->get('description'),
            ]);
            $photo->save(); // Finally, save the record.
        }

        return view('photos.create');
    }

    public function destroy($id)
    {
        $photos = Photo::where('id', $id)->firstorfail()->delete();
        return redirect()->route('photos.index');
    }
}