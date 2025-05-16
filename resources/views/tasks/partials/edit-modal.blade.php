<div id="editModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-40 flex justify-center items-center">
    <div class="bg-white p-6 rounded w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Task</h2>
        <form id="editTaskForm">
            @csrf
            <input type="hidden" name="id">
            <input name="title" class="w-full mb-2 p-2 border" placeholder="Title" required>
            <textarea name="description" class="w-full mb-2 p-2 border" placeholder="Description"></textarea>
            <input type="date" name="due_date" class="w-full mb-2 p-2 border">
            <select name="status" class="w-full mb-2 p-2 border" required>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
            <select name="priority" class="w-full mb-4 p-2 border" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Update</button>
                <button type="button" id="closeEditModal" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>
