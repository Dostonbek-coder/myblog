{{-- @extends('layouts')
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Followed Posts</h1>

        @if ($posts->isEmpty())
            <p class="text-gray-600">Sizda hali postlar yo'q.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <!-- Rasm qismi -->
                      @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image->url) }}" class="card-img-top" alt="Post Image">
                        @else
                            <img src="{{ asset('path/to/default-image.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif
                           
                        <!-- Kontent qismi -->
                        <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>

                        <p class="text-gray-700 mb-4">
                            {{ Str::limit($post->body, 100) }}
                        </p>
                        {{-- @foreach ($users as $user) --}}
                            
                        {{-- @endforeach --}}
                        <div class="flex items-center justify-between">
                            <a href="{{ route('profile.show', $post->user) }}"
                                class="text-indigo-700 hover:text-indigo-900 flex items-center">
                                @if ($post->user->image)
                                    <img src="{{ asset('storage/' . $post->user->image->url) }}"  
                                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/40" 
                                         class="rounded-circle" width="40" height="40" alt="Default Avatar">
                                @endif
                                <!-- Added whitespace-nowrap and margin-left -->
                                <span class="whitespace-nowrap ml-2">{{ $post->user->name }}</span>
                            </a>
                            <a href="{{ route('posts.show', $post) }}"
                                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach 
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </main>
@endsection --}}
