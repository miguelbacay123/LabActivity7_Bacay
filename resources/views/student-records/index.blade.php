<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        .welcome {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1em;
            color: #555;
        }

        .top-bar {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        form {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 8px 16px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .add-button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .add-button i {
            margin-right: 6px;
        }

        .courses-button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .courses-button i {
            margin-right: 6px;
        }

        .student-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .student-card {
            background-color: white;
            border: 2px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            width: 280px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .student-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0,0,0,0.12);
        }

        .student-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .student-card p {
            margin: 5px 0;
        }

        .logout {
            text-align: center;
            margin-top: 40px;
        }

        .logout button {
            background-color: #dc3545;
        }

        .logout button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Student Records</h1>
    <div class="welcome">Welcome, {{ auth()->user()->name }}!</div>

    <div class="top-bar">
        <form method="GET" action="{{ url('/student-records') }}">
            <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
        <a href="{{ url('/student-records/create') }}"><button class="add-button"><i class="fas fa-user-plus"></i> Add Student</button></a>
        <a href="{{ url('/courses') }}"><button class="courses-button"><i class="fas fa-book"></i> Manage Courses</button></a>
    </div>

    <div class="student-list">
        @if(isset($students) && count($students))
            @foreach($students as $student)
                <div class='student-card'>
                    <h3>{{ $student->name }}</h3>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                    <p><strong>Student ID:</strong> {{ $student->id }}</p>
                    <p><strong>Program:</strong> {{ $student->course }}</p>
                    <div class='card-actions'>
                        <a href='{{ url("/student-records/{$student->id}/edit") }}'>
                            <button class='edit-btn'><i class='fas fa-edit'></i> Edit</button>
                        </a>
                        <form method="POST" action="{{ url("/student-records/{$student->id}") }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='delete-btn' onclick='return confirm("Are you sure?")'>
                                <i class='fas fa-trash'></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p style='text-align: center;'>No student records found.</p>
        @endif
    </div>

    <div class="logout">
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</body>
</html>