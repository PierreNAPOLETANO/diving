<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::All();
        return view('videos.index', ['videos' => $videos]);
    }

    public function create()
    {
        return view('videos.create');
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
                'image' => 'mimes:mp4,avi,mpeg' // Only allow .mp4, .avi and .mpeg file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /photos
            $request->file->store('photo', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $photo = new Video([
                "name" => $request->get('name'),
                "country" => $request->get('country'),
                "video" => $request->file->hashName(),
                "description" => $request->get('description'),
            ]);
            $photo->save(); // Finally, save the record.
        }

        return view('videos.create');
    }

    public function destroy($id)
    {
        $videos = Video::where('id', $id)->firstorfail()->delete();
        return redirect()->route('videos.index');
    }
}
