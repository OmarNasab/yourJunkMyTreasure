<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsList extends Component
{
    use WithPagination;
    public string $sortBy="posts.created_at";
    public  $seller;
    public  $category;
    private $posts;

    protected $listeners = ['selectBy' => 'selectBy',"clear"=>"clear"];


    public function selectBy($type, $value){
        if($type=="category"){
            $this->category=$value;
        }else{
            $this->seller=$value;
        }

    }

    public function clear(){
        $this->sortBy="posts.created_at";
        $this->seller=null;
        $this->category=null;

    }


    public function render(): Factory|View|Application
    {
        $this->posts = Post::query()
            ->join("users","users.id","=","posts.user_id")
            ->join("categories","categories.id","=","posts.category_id")
            ->when($this->category!=null,function ($q){
                $q->where("category_id",$this->category);
            })
            ->when($this->seller!=null,function ($q){
                $q->where("user_id",$this->seller);
            })
            ->select(["posts.title","posts.description","posts.image","users.email","posts.price","posts.created_at","posts.category_id","posts.user_id","users.name","categories.name"])
            ->orderBy($this->sortBy)
            ->paginate(16);
        $posts=$this->posts;
        return view('livewire.products-list',compact("posts"));
    }
}
