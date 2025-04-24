@extends('layouts.posts')

@section('content')
<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex flex-col sm:flex-row items-center mb-4">
                <!-- User Avatar -->
                <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('images/default-avatar.png') }}" 
                     alt="User Avatar"
                     class="w-20 h-20 rounded-full mr-4 mb-4 sm:mb-0">
                
                <div class="text-center sm:text-left">
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{$user->username }}</p>
                </div>

                <!-- Follow/Unfollow Button and Edit Profile -->
                <div class="mt-4 sm:mt-0 sm:ml-auto space-x-2">
                    @auth
                        @if(auth()->id() === $user->id)
                            <a href="{{ route('profile.edit', $user) }}" 
                               class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                Edit Profile
                            </a>
                        @else
                            <form action="{{ route('users.follow', $user) }}" method="POST" class="inline"> 
                                @csrf
                                <button type="submit" 
                                        class="{{ auth()->user()->isFollowing($user) ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white font-semibold py-2 px-4 rounded">
                                    {{ auth()->user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Stats -->
            <div class="flex flex-wrap justify-center sm:justify-start space-x-4">
                <span class="font-semibold">{{ $user->followers()->count() }} Followers</span>
                <span class="font-semibold">{{ $user->following()->count() }} Following</span>
                <span class="font-semibold">{{ $user->posts()->count() }} Posts</span>
            </div>
        </div>

        <!-- Posts Section -->
        <h2 class="text-2xl font-bold mb-4">{{ $user->name }}'s Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" 
                             alt="Post Image"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                    @endif
                    
                    <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ Str::limit($post->body, 100) }}</p>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('posts.show', $post) }}" 
                           class="text-indigo-600 hover:text-indigo-800">
                           Read More
                        </a>
                        
                        @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" 
                           class="text-green-600 hover:text-green-800">
                           Edit
                        </a>
                        @endcan
                        
                        @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No posts yet.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</main>
@endsection