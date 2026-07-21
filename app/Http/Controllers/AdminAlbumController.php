<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAlbumController extends Controller
{
    public function index()
    {
        return view('admin.album.index', [
            'title' => 'Manajemen Album',
            'page' => 'album',
            'albums' => Album::withCount('galeris')->orderByDesc('tanggal')->orderByDesc('id')->paginate(200),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'cover' => 'nullable|image|max:10240',
        ]);

        if ($request->file('cover')) {
            $validated['cover'] = $request->file('cover')->store('album-cover');
        }

        Album::create($validated);

        return redirect('/admin/album')->with('success', 'Album berhasil ditambahkan.');
    }

    public function show(Album $album)
    {
        return view('admin.album.show', [
            'title' => 'Album: ' . $album->judul,
            'page' => 'album',
            'album' => $album,
            'galeris' => $album->galeris()->latest()->paginate(200),
        ]);
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'cover' => 'nullable|image|max:10240',
        ]);

        if ($request->file('cover')) {
            if ($album->cover && str_starts_with($album->cover, 'album-cover/')) {
                Storage::delete($album->cover);
            }
            $validated['cover'] = $request->file('cover')->store('album-cover');
        }

        $album->update($validated);

        return redirect('/admin/album')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        // Photos are kept (album_id nulls out via FK) — they may still belong
        // to a paket gallery. Only the album grouping and its cover go away.
        if ($album->cover && str_starts_with($album->cover, 'album-cover/')) {
            Storage::delete($album->cover);
        }
        $album->delete();

        return redirect('/admin/album')->with('success', 'Album berhasil dihapus. Foto di dalamnya tidak ikut terhapus.');
    }

    public function storeFoto(Request $request, Album $album)
    {
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis' => 'required|in:gambar,video',
            'file_path' => 'required|file|max:512000',
        ]);

        $validated['file_path'] = $request->file('file_path')->store('album-galeri');
        $validated['album_id'] = $album->id;
        $validated['nama'] = $validated['nama'] ?? $album->judul;

        Galeri::create($validated);

        if (! $album->cover && $validated['jenis'] === 'gambar') {
            $album->update(['cover' => $validated['file_path']]);
        }

        return redirect('/admin/album/' . $album->id)->with('success', 'Foto berhasil ditambahkan ke album.');
    }

    public function destroyFoto(Album $album, Galeri $galeri)
    {
        abort_unless($galeri->album_id === $album->id, 404);

        // Photos that also belong to a paket gallery are only detached from
        // the album; photos uploaded directly into the album are deleted.
        if ($galeri->paket_id) {
            $galeri->update(['album_id' => null]);
            $message = 'Foto dilepas dari album (tetap ada di galeri paket).';
        } else {
            if (str_starts_with($galeri->file_path ?? '', 'album-galeri/')) {
                Storage::delete($galeri->file_path);
            }
            $galeri->delete();
            $message = 'Foto berhasil dihapus.';
        }

        return redirect('/admin/album/' . $album->id)->with('success', $message);
    }
}
