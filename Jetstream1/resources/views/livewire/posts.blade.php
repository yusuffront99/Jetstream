<x-slot name="header">
    <h2 class="text-center">Tutorial CRUD Laravel dengan Jetstream Livewire</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="py-3">
                <p class="text-sm">{{ session('message') }}</p>
            </div>
            @endif
            <button wire:click="create()" class="bg-indigo-500 text-white font-bold py-2 px-4 rounded my-3">Create Post</button>
            @if($isModalOpen)
            <x-post.form/>
            @endif
            <table class="table-fixed w-full mt-5">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Desc</th>
                        <th class="px-4 py-2">Author</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($posts as $post)
                    <tr>
                        <td class="border px-4 py-2">{{ ++$no }}</td>
                        <td class="border px-4 py-2">{{ $post->title }}</td>
                        <td class="border px-4 py-2">{{ Str::limit($post->body,70) }}</td>
                        <td class="border px-4 py-2">{{ $post->user->name }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $post->id }})"
                                class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" wire:click="delete({{ $post->id }})">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p class="text-center">No Data</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>