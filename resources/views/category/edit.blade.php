<x-app-layout>
    <div class="m-12 mx-52 bg-white rounded-lg">
        <div class="flex justify-between py-4 mb-4 border-0 border-b-2 p-10">
            <h2 class="text-4xl font-extrabold dark:text-white">Update {{$category->name}}</h2>
            <x-page-link :route="route('category.index')">
                Categories List
            </x-page-link>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg px-10 pb-10">
            <form method="POST" action="{{route("category.update",$category)}}">
                @csrf
                @method("PUT")
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                    <input type="text" value="{{$category->name}}" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Category Name" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex justify-center">
                    <x-primary-button>Edit Category</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

