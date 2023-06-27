<x-app-layout>
    <div class="m-12 mx-52 bg-white rounded-lg">
        <div class="flex justify-between py-4 mb-4 border-0 border-b-2 p-10">
            <h2 class="text-4xl font-extrabold dark:text-white">Post List</h2>
            <x-page-link :route="route('post.create')">
                Add Post
            </x-page-link>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg p-10">
            <table class="w-full shadow-md text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$post->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$post->category->name}}
                    </td>
                    <td class="w-32 p-4">
                        <img src="{{asset("storage/".$post->image)}}" class="h-auto max-w-2xs">
                    </td>
                    <td class="px-6 py-4">
                        {{$post->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-4">
                            <a href="{{route("post.edit",$post)}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                           <x-delete-modal :id="$post->id" name="post" :route="route('post.destroy',$post)"></x-delete-modal>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td colspan="5" class="px-6 py-4 text-center">No Data available</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $posts->links()}}
        </div>
    </div>

</x-app-layout>
