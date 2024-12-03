<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function edit($id)
    {
        $content = Content::findOrFail($id); // Pastikan $id adalah content_id
        return view('content.edit', compact('content'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content_text' => 'required|string',
        ]);
    
        $content = Content::findOrFail($id);
        $content->update($request->all());
    
        return redirect()->route('content.show', $content->course_id)->with('success', 'Content updated successfully!');
    }
    
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
    
        return redirect()->route('content.show', $content->course_id)->with('success', 'Content deleted successfully!');
    }
    
    public function show($courseId)
    {
        $course = Course::with('contents')->findOrFail($courseId);
        return view('content.show', compact('course'));
    }

    public function create($courseId)
    {
        return view('content.create', compact('courseId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content_text' => 'required|string',
            'course_id' => 'required|exists:course,course_id', // Pastikan course_id valid
        ]);

        Content::create($request->all());

        return redirect()->route('content.show', $request->course_id)->with('success', 'Content created successfully!');
    }

    public function markAsDone(Request $request, $contentId)
    {
        $request->validate([
            'user_id' => 'required|integer', // Validasi user_id
            'is_done' => 'required|boolean', // Validasi is_done
        ]);
    
        $content = Content::findOrFail($contentId);
    
        // Update progress JSON
        $progress = json_decode($content->progress, true) ?? [];
        $progress["user_id_{$request->user_id}"] = $request->is_done;
    
        $content->progress = json_encode($progress);
        $content->save();
    
        return redirect()->back()->with('success', 'Progress updated successfully!');
    }
}
