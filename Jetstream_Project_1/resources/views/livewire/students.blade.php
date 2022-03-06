<x-slot name="header">
    <h2 class="text-center">Student Data SMPN 1 Harapan Nusantara</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
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
            <button wire:click="create()" class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">New Student</button>
            @if($isOpenModal)
            @include('components.form.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Age</th>
                        <th class="px-4 py-2">Div/Class</th>
                        <th class="px-4 py-2">Gender</th>
                        <td class="px-4 py-2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->id }}</td>
                        <td class="border px-4 py-2">{{ $item->name }}</td>
                        <td class="border px-4 py-2">{{ $item->age }}</td>
                        <td class="border px-4 py-2">{{ $item->div}}</td>
                        <td class="border px-4 py-2">{{ $item->gender }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $item->id }})"
                                class="bg-blue-500  text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $item->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>