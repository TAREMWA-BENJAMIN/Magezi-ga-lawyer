<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Act;
use Illuminate\Support\Facades\Storage;

class ActController extends Controller
{
    public function index()
    {
        return response()->json(Act::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|string|max:4',
            'pdf_document' => 'required|file|mimes:pdf|max:20480', // max 20MB
        ]);

        $file = $request->file('pdf_document');
        $path = $file->store('acts', 'public');
        
        // Calculate file size in human readable format
        $bytes = $file->getSize();
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        $fileSize = round($bytes, 1) . ' ' . $units[$pow];

        $act = Act::create([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'file_path' => $path,
            'file_size' => $fileSize,
        ]);

        return response()->json($act, 201);
    }

    public function destroy($id)
    {
        $act = Act::findOrFail($id);
        
        if (Storage::disk('public')->exists($act->file_path)) {
            Storage::disk('public')->delete($act->file_path);
        }
        
        $act->delete();
        
        return response()->json(['message' => 'Act deleted successfully']);
    }
}
