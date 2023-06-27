<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{

    public function index(): Factory|View|Application
    {
        $categories=Category::query()->paginate(10);
        return view("category.index",compact("categories"));
    }
    public function create(): Factory|View|Application
    {
        return view("category.create");
    }
     public function store(StoreCategoryRequest $request): RedirectResponse
     {
        Category::query()->create($request->validated());
        return redirect()->route("category.index")->with(["alert"=>"success","message"=>"Category Created Successfully"]);
     }

     public function edit(Category $category): Factory|View|Application
     {
        return view("category.edit",compact("category"));
     }

     public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
     {
         $category->update($request->validated());
         return redirect()->route("category.index")->with(["alert"=>"success","message"=>"Category ".$category->name." Updated Successfully"]);
     }

     public function destroy(Category $category): RedirectResponse
     {

         if ($category->posts()->count()>0){
             $message=["alert"=>"error","message"=>"Can't delete a category that has posts using it"];
         }else{
             $category->delete();
             $message=["alert"=>"success","message"=>"Post  Deleted Successfully"];
         }

         return redirect()->route("category.index")->with($message);
     }
}
