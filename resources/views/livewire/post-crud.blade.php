<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 flex flex-col items-center p-6">
    <div class="w-full max-w-4xl bg-white shadow-xl rounded-2xl p-8">
        <!-- Header & Create Post Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Manage Posts</h2>
            <button wire:click="create()"
                    class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-full hover:bg-blue-700 hover:shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-4 focus:ring-blue-400 focus:ring-offset-2">
                + New Post
            </button>
        </div>

        <!-- Posts Table -->
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow-lg">
            <table class="w-full border-collapse bg-white rounded-lg">
                <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <th class="p-4 text-left border-b">Title</th>
                    <th class="p-4 text-left border-b">Content</th>
                    <th class="p-4 text-center border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <tr wire:key="post-{{ $post->id }}" class="border-b hover:bg-gray-50 transition">
                            <td class="p-4">{{ $post->title }}</td>
                            <td class="p-4 truncate max-w-xs">{{ $post->content }}</td>
                            <td class="p-4 flex justify-center space-x-2">
                                <button wire:click="edit({{ $post->id }})"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 shadow-md transition">
                                    ✏️ Edit
                                </button>
                                <button onclick="confirmDelete({{ $post->id }})"
                                        class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 shadow-md transition">
                                    🗑 Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center p-6 text-gray-500">No posts available</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Create/Edit Post -->
    @if($isOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">{{ $postId ? 'Edit Post' : 'New Post' }}</h2>

                <input type="text" wire:model="title"
                       class="w-full border p-3 rounded-lg mb-2 focus:ring-4 focus:ring-blue-400 focus:outline-none"
                       placeholder="Title">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <textarea wire:model="content"
                          class="w-full border p-3 rounded-lg mb-2 focus:ring-4 focus:ring-blue-400 focus:outline-none"
                          placeholder="Content"></textarea>
                @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <div class="flex justify-end space-x-4">
                    <button wire:click="save()"
                            class="bg-blue-500 text-white px-5 py-2 rounded-full hover:bg-blue-600 shadow-md transition">
                        ✅ Save
                    </button>
                    <button wire:click="$set('isOpen', false)"
                            class="bg-gray-500 text-white px-5 py-2 rounded-full hover:bg-gray-600 shadow-md transition">
                        ❌ Close
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>

<!-- SweetAlert2 delete Confirmation -->
<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(`confirmDelete ${postId}`); // Debugging
                // Call Livewire method to delete the post
                Livewire.dispatch('confirmDelete', { postId: postId });
            }
        });
    }
</script>
