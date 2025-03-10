<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        Manage Posts (Laravel 9 Livewire CRUD with Jetstream & Tailwind CSS - ItSolutionStuff.com)
    </h2>
</x-slot>
<div wire:wire:transition class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New
                Post</button>
            @if($isOpen) @include('livewire.posts.create') @endif <div class="space-y-5">
                <div class="pt-3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" id="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Search Post..." required="">
                    <div class="flex justify-between items-center mb-4 mt-3">
                        <div class="flex items-center">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-2"
                                for="itemsPerPage">
                                Items per page:
                            </label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pr-6"
                                wire:model="itemsPerPage" wire:change="updateItemsPerPage($event.target.value)">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="pagination-sm my-3 pb-3">
                        {{ $posts->links() }}
                    </div>


                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Body</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @foreach($posts as $post)
                        <tr>
                            <td class="border px-4 py-2">{{ $post->id }}</td>
                            <td class=" border px-4 py-2">{{ $post->title }}</td>
                            <td class="border px-4 py-2">{{ $post->content }}</td>
                            <td class=" border px-4 py-2 space-y-2">
                                <button wire:click="edit({{ $post->id }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full h-11">Edit</button>
                                <button wire:click="delete({{ $post->id }})"
                                    wire:confirm="Are you sure deleting this post? \n Title: {{ $post->title }}\n content: {{ $post->content }}"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full h-11">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- pagination -->
                <div class="pagination-sm my-3">
                    {{ $posts->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </div>