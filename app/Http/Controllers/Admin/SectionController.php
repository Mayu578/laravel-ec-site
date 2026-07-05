<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // セクション一覧
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    // 新規フォーム
    public function create()
    {
        $categories = ['lifestyle', 'furniture']; // 固定カテゴリ
        return view('admin.sections.create', compact('categories'));
    }

    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required|in:lifestyle,furniture',
        ]);

        Section::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Added a section');
    }

    // 削除
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted');
    }
}
