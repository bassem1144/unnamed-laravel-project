@extends('layouts.app')

@section('content')

    @include('layouts.navbar')

    @if ($tasks->count() > 0)
        <div class="bg-white rounded-md shadow-md overflow-hidden p-4 mx-auto mt-8 max-w-2xl">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Task</th>
                        <th class="py-2 px-4 border-b text-left">Description</th>
                        <th class="py-2 px-4 border-b text-left">Due date</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('task.edit', $task->id) }}" class="text-blue-500 hover:underline">
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $task->description }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($task->due_date == now()->format('Y-m-d'))
                                    <span class="text-red-500">{{ $task->due_date }}</span>
                                @else
                                    {{ $task->due_date }}
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ ucwords(str_replace('_', ' ', $task->status)) }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('markAsDone', ['GUID' => $task->GUID]) }}"
                                    class="text-green-500 hover:text-green-700">
                                    <button
                                        class="bg-green-200 text-green-800 py-2 px-4 rounded-full hover:bg-green-300 focus:outline-none focus:shadow-outline-green active:bg-green-400">
                                        Done
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white rounded-md shadow-md overflow-hidden p-4 mx-auto mt-8 max-w-2xl">
            <h1 class="text-2xl font-semibold mb-6">No Tasks</h1>
            <p class="text-gray-600">You have no tasks.</p>
            <p class="text-gray-600">Click <a href="{{ route('task.create') }}" class="font-bold text-blue-500">here</a> to
                add your first task.</p>
        </div>
    @endif

@endsection
