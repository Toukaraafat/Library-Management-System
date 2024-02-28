<?php
//simple logic pages
namespace App\Http\Controllers; //ana ka class mawgod fen

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all(); //select * from posts collection object
        // dd($postsFromDB);
        // $localName = 'touka on controller';
        // $newBooks =['php', 'javascript','css'];
        // return view('test', ['name' => $localName, 'books' => $newBooks]);

        return view('posts.crud', ['posts' => $postsFromDB]);
    }

    //convention over configuration --> btkhtsr 3alia ktabt l code 
    public function show(Post $post) //route model binding type hinting
    // public function show($postId)
    {
        // $singlePostFromDB = Post::findorfail($postId); //select * from posts where id = $postId; model object
        // $singlePostFromDB = Post::where('id', $postId)->first;
        // $singlePost = ['id' => 1, 'title' => 'php', 'desc' => 'this is description.', 'posted_by' => 'touka', 'created_at' => '2024-02-15'];
        // return $postId ;
        return view('posts.show', ['post' => $post]);
        // return view('posts.show', ['post' => $singlePostFromDB]);

        // if(is_null($singlePostFromDB)){
        //     return to_route('posts.index');
        // }
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        // 1- get user data
        // $request = request();
        // dd($request);
        $data = request()->all();
        // dd($data);

        $title = request()->title;
        $desc = request()->description;
        $postCreator = request()->postCreator;


        //    dd ($data, $title,$desc,$postCreator );
        // 2- store the user data in database
        $post = new Post;
        $post->title = $title;
        $post->description = $desc;
        $post->save();

        // 3- redirection to posts.index 
        return to_route('posts.index');
    }


    public function edit(Post $post)//route model binding  3shan a70t l data fe mkanha w a3ml edit 3aleha
    {
        $users = User::all();
        return view('posts.edit', ['users' => $users, 'post' => $post]);

    }
    public function update($postId)
    {
        $title = request()->title;
        $desc = request()->description;
        $postCreator = request()->postCreator;
        $singlePostFromDB = Post::findorfail($postId); //select * from posts where id = $postId; model object
        $singlePostFromDB -> update([
            "title" => $title,
            "description" => $desc,
        ]);
        return to_route('posts.show', $postId);
    }
    public function destroy(Post $post)
    {
        // confirm('Are you sure you want to delete');
        $post -> delete();

        return to_route('posts.index', ['post' => $post]);

    }

}