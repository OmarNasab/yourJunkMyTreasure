<x-app-layout>
    <div class="m-12 mx-52 bg-white rounded-lg">
        <div class="flex justify-between py-4 mb-4 border-0 border-b-2 p-10">
            <h2 class="text-4xl font-extrabold dark:text-white">Create New Post</h2>
            <x-page-link :route="route('post.index')">
                Post List
            </x-page-link>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg px-10 pb-10">
            <form method="post" action="{{route("post.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                        Title</label>
                    <input type="text" id="title" value="{{old("title")}}" name="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Enter Post Title" required>
                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        an option</label>
                    <select id="category_id" name="category_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option disabled selected value="">Choose a Category</option>
                        @forelse($categories as $category)
                            <option
                                value="{{$category->id}}"{{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @empty
                            <option class="text-center" disabled value="">Categories not Found</option>
                        @endforelse
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                </div>
                <div class="mb-6">
                    <label for="price"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300
                         rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            RM
                        </span>
                        <input type="number" id="price" name="price"-
                               class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Enter price" value="{{old("price")}}">
                    </div>
                    <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                </div>
                <div class="mb-4">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                        Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="Enter Post Description">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                </div>
                <div class="mb-4" x-data="{ file: null }">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                               class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div x-show="!file" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                                    or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="dropzone-file" name="image" type="file" class="hidden"
                                   @change="file = $event.target.files[0]"/>
                            <div x-show="file" class="text-center">
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">File Selected</p>
                                <p x-text="file.name" class="mb-2 text-sm text-gray-500 dark:text-gray-400"></p>
                            </div>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                </div>
                <div class="flex justify-center">
                    <x-primary-button>Add Post</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
