<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    function index()
    {
        $project = Project::latest()->paginate(10);
        return view('admin.project-menu', compact('project'));
    }

    public function create()
    {
        return view('admin.project-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:projects,slug',
            'category' => 'required|in:neonbox,billboard,huruf-timbul,indoor-outdoor',
            'location' => 'required|max:255',
            'cropped_image' => 'nullable'
        ]);

        // AUTO SLUG kalau kosong
        if (!$data['slug']) {
            $data['slug'] = Str::slug($data['title']);
        }

        // HANDLE IMAGE (BASE64)
        if ($request->cropped_image) {

            $image = $request->cropped_image;

            // hapus prefix base64
            $image = preg_replace('/^data:image\\/(png|jpg|jpeg);base64,/', '', $image);
            $image = str_replace(' ', '+', $image);

            // nama file SEO
            $imageName = 'projects/' . $data['slug'] . '-' . time() . '.png';

            // simpan ke storage
            Storage::disk('public')->put($imageName, base64_decode($image));

            $data['image'] = url(Storage::url($imageName));
        }

        Project::create($data);

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan');
    }
}
