<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function ajaxDelete(Request $request)
    {
        $request->validate([
            'image_id' => 'required|integer'
        ]);

        $image = Image::findOrFail($request->image_id);

        // seguridad: verificar dueño del vehículo
        if ($image->imageable->user_id !== auth()->id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        // borrar archivo físico
        Storage::disk('public')->delete($image->path);

        // borrar registro
        $image->delete();

        return response()->json(['success' => true]);
    }
}
