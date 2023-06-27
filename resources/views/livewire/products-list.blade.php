<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Product List</h1>
    <div class="mb-4">

        <label class="ml-4 mr-2 font-bold">Sort By:</label>
        <div class="flex flex-row justify-between">
            <div>
                <select wire:model="sortBy" class="border w-full rounded-lg">
                    <option value="posts.created_at">Date</option>
                    <option value="users.name">Seller</option>
                    <option value="categories.name">Category</option>
                </select>
            </div>
            <x-primary-button wire:click="$emit('clear')">Clear</x-primary-button>
        </div>
    </div>
    <div class="flex flex-wrap mx-2">
        @foreach($posts as $post)
            <div class="md:w-1/4 px-2 mb-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <img src="{{asset("storage/".$post->image)}}" alt="Product 1" class="w-full mb-2">
                    <div class="flex flex-row justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-blue-600">{{$post->title}}</h2>
                        </div>
                        <div class="hover:scale-125 hover:cursor-pointer">
                            <span wire:click="$emit('selectBy','category',{{$post->category_id}})"
                                  class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{$post->category->name}}</span>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-2">{{$post->description}}</p>
                    <div wire:click="$emit('selectBy','user',{{$post->user_id}})"
                         class="cursor-pointer text-gray-600  flex items-center mt-4 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p>{{$post->user->name}}</p>
                    </div>
                    <div class="flex items-center mt-2">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M22 6l-6 6M2 6l6 6"></path>
                        </svg>
                        <p class="text-gray-600">{{$post->user->email}}</p>
                    </div>
                    <div class="mt-2">
                        <p class="text-gray-600 font-medium">RM {{$post->price}}</p>
                    </div>
                    <div class="text-right font-thin text-sm text-grey-300">
                        <p class="text-right font-light text-xs">{{$post->created_at}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    </div>
</div>
