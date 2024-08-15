<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UploadImage;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.uploadImage.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.uploadImage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('user-uploads/products', 'public');

                $uploadImage = new UploadImage();
                $uploadImage->image = $path; 
                $uploadImage->save();
            }
            return redirect()->route('admin.dashboard')->with('success', 'Images uploaded successfully.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'No images found.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the existing UploadImage record by its ID
        $uploadImage = UploadImage::findOrFail($id);

        // To store the new image paths
        $updatedImages = [];

        if ($request->hasFile('image')) {
            // Loop through the uploaded files
            foreach ($request->file('image') as $image) {
                // Store the new image in the specified directory
                $path = $image->store('user-uploads/products', 'public');

                // Update the image path in the database (assuming you're only storing the latest image)
                $uploadImage->image = $path;
                $uploadImage->save();

                $updatedImages[] = $path;
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Images updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
