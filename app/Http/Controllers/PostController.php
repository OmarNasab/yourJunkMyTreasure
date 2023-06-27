<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index(): Factory|View|Application
    {
        /** @var User $user */
        $user=Auth::user();
        $posts=Post::query()->with("category");
        if ($user->isAdmin()){
           $posts=$posts->paginate(10);
        }else{
            $posts=$posts->where("user_id",$user->id)->paginate(10);
        }
        return view("post.index",compact("posts"));
    }
    public function create(): Factory|View|Application
    {
        $categories=Category::all();
        return view("post.create",compact("categories"));
    }
    public function store(StorePostRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $image=$request->file("image");
        $path=$image->storeAs("images",$image->getClientOriginalName(),"public");
        $validatedData["image"]=$path;
        Post::query()->create($validatedData);
        return redirect()->route("post.index")->with(["alert"=>"success","message"=>"Post Created Successfully"]);
    }

    public function edit(Post $post): Factory|View|Application
    {
        $categories=Category::all();
        return view("post.edit",compact(["categories","post"]));
    }

    public function update(UpdatePostRequest $request, Post $post){
        $validatedData = $request->validated();
        if($request->file("image")!=null){
            File::delete(public_path("storage/".$post->image));
            $image=$request->file("image");
            $path=$image->storeAs("images",$image->getClientOriginalName(),"public");
            $validatedData["image"]=$path;
        }else{
            $validatedData["image"]=$post->image;
        }

        $post->update($validatedData);
        return redirect()->route("post.index")->with(["alert"=>"success","message"=>"Post ".$validatedData["title"]." Updated Successfully"]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        File::delete(public_path("storage/".$post->image));
        $post->delete();
        return redirect()->route("post.index")->with(["alert"=>"success","message"=>"Post  Deleted Successfully"]);
    }
}
