<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index()
    {
        return view('admin.faq.index', [
            'title' => 'Kelola FAQ',
            'page' => 'faq',
            'faqs' => Faq::orderBy('kategori')->orderBy('urutan')->paginate(200),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        Faq::create($validated);

        return redirect('/admin/faq')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'kategori' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        $faq->update($validated);

        return redirect('/admin/faq')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect('/admin/faq')->with('success', 'FAQ berhasil dihapus.');
    }
}
