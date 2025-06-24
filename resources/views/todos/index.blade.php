<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Todo List</h1>

    <form action="{{ route('todos.create') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="New todo">
        <button type="submit">Add</button>
    </form>

    <ul>
        @foreach($todos as $todo)
            <li>
                <form action="{{ route('todos.toggle', $todo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">
                        {{ $todo->completed ? '✔️' : '❌' }}
                    </button>
                </form>

                {{ $todo->title }}

                <form action="{{ route('todos.delete', $todo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">🗑️</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
