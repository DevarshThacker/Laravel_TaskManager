@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="bg-color: #7986cb;">
    <div class="container mx-auto px-4 py-6">
        <h1 class="lavender-header-title text-3xl font-bold mb-4">Task Manager</h1>

        <button id="openCreateModal" class="lavender-btn mb-3">+ Add Task</button>

        <div class="flex items-center space-x-4 mt-4 mb-4">
            <input id="searchInput" class="lavender-input p-2" placeholder="Search title...">
            <select id="statusFilter" class="lavender-select p-2">
                <option value="">All Status</option>
                <option>Pending</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
            <select id="priorityFilter" class="lavender-select p-2">
                <option value="">All Priority</option>
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
            <button id="applyFilters" class="lavender-btn">Filter</button>
        </div>

        <div class="row g-4" id="taskCards">
            {{-- Rendered by JS --}}
        </div>
    </div>
</div>

{{-- Modals --}}
@include('tasks.partials.create-modal')
@include('tasks.partials.edit-modal')
@endsection

@push('scripts')
<!-- Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- jQuery CDN (already included in your script section, but for reference) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/heroicons@2.0.16/dist/heroicons.min.js"></script>
<script>
    const csrf = '{{ csrf_token() }}';

    // $.ajaxSetup({
    //     xhrFields: { withCredentials: true }
    // });
// ...existing code...
function loadTasks() {
    $.get('/tasks/list', function(tasks) {
        const search = $('#searchInput').val().toLowerCase();
        const status = $('#statusFilter').val();
        const priority = $('#priorityFilter').val();

        const filtered = tasks.filter(t =>
            (!search || t.title.toLowerCase().includes(search)) &&
            (!status || t.status === status) &&
            (!priority || t.priority === priority)
        );

        const html = filtered.map(task => `
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="lavender-card p-4 h-100 d-flex flex-column justify-content-between shadow">
                    <div>
                        <h3 class="mb-2 lavender-header-title">${task.title}</h3>
                        <p class="mb-2 text-secondary fst-italic">${task.description || '-'}</p>
                        <div class="mb-2">
                            <span class="badge me-1
                                ${task.status === 'Pending' ? 'badge-status-pending' : ''}
                                ${task.status === 'In Progress' ? 'badge-status-inprogress' : ''}
                                ${task.status === 'Completed' ? 'badge-status-completed' : ''}">
                                ${task.status}
                            </span>
                            <span class="badge me-1
                                ${task.priority === 'Low' ? 'badge-priority-low' : ''}
                                ${task.priority === 'Medium' ? 'badge-priority-medium' : ''}
                                ${task.priority === 'High' ? 'badge-priority-high' : ''}">
                                ${task.priority}
                            </span>
                            <span class="badge bg-white text-secondary border">${task.due_date || '-'}</span>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end gap-2">
                        <button onclick="editTask(${task.id})" class="lavender-btn">Edit</button>
                        <button onclick="deleteTask(${task.id})" class="lavender-btn">Delete</button>
                    </div>
                </div>
            </div>
        `).join('');

        $('#taskCards').html(html);
    });
}
// ...existing code...

    // Create Task
    $('#createTaskForm').on('submit', function(e) {
        e.preventDefault();
        const data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: '/tasks',
            data,
            headers: { 'X-CSRF-TOKEN': csrf },
            success: function() {
                $('#createModal').addClass('hidden');
                $('#createTaskForm')[0].reset();
                loadTasks();
            },
            error: function(err) {
                alert(err.responseJSON?.message || 'Error creating task');
            }
        });
    });

    // Delete Task
    function deleteTask(id) {
        if (!confirm('Delete this task?')) return;

        $.post(`/tasks/${id}/delete`, {_token: csrf}, function() {
            loadTasks();
        }).fail(err => alert('Delete failed'));
    }

    // Edit Task
    function editTask(id) {
        $.get('/tasks/list', function(tasks) {
            const task = tasks.find(t => t.id === id);
            if (!task) return alert('Task not found');

            $('#editTaskForm input[name="id"]').val(task.id);
            $('#editTaskForm input[name="title"]').val(task.title);
            $('#editTaskForm textarea[name="description"]').val(task.description);
            $('#editTaskForm input[name="due_date"]').val(task.due_date);
            $('#editTaskForm select[name="status"]').val(task.status);
            $('#editTaskForm select[name="priority"]').val(task.priority);

            $('#editModal').removeClass('hidden');
        });
    }

    $('#editTaskForm').on('submit', function(e) {
        e.preventDefault();
        const id = $('#editTaskForm input[name="id"]').val();
        const data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: `/tasks/${id}/update`,
            data,
            headers: { 'X-CSRF-TOKEN': csrf },
            success: function() {
                $('#editModal').addClass('hidden');
                loadTasks();
            },
            error: function(err) {
                alert(err.responseJSON?.message || 'Update failed');
            }
        });
    });

    // Modal Controls
    $('#openCreateModal').click(() => {
        $('#createModal').removeClass('hidden');
        $('#createTaskForm')[0].reset();
    });

    $('#closeCreateModal').click(() => $('#createModal').addClass('hidden'));
    $('#closeEditModal').click(() => $('#editModal').addClass('hidden'));

    // Filter Button
    $('#applyFilters').click(() => loadTasks());

    // Initial Load
    loadTasks();
</script>
@endpush
