<!-- <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\DiscussionForum;
// use App\Models\ForumPost;
// use Illuminate\Support\Facades\Auth; // Pastikan sudah di-import

// class ForumController extends Controller
// {
//     public function index(Request $request)
//     {
//         if (Auth::check()) {
//             // User sudah login, tampilkan forum
//             $forums = DiscussionForum::all();
//             return view('Forum.discussion-forum', ['forums' => $forums]);
//         } else {
//             // User belum login, redirect ke halaman login
//             return redirect()->route('login'); 
//         }
//     }

//     public function createPost(Request $request, $forumId)
//     {
//         $request->validate([
//             'content' => 'required|string'
//         ]);

//         ForumPost::create([
//             'forum_id' => $forumId,
//             'user_id' => Auth::user()->id, // Menggunakan Auth::user()
//             'content' => $request->content,
//         ]);

//         return redirect()->back()->with('success', 'Postingan berhasil ditambahkan!');
//     }
// } -->