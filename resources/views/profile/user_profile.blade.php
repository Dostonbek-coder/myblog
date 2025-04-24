@extends('layouts.posts') {{-- Layoutingiz nomi to'g'ri ekaniga ishonch hosil qiling --}}

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            {{-- FOYDALANUVCHI PROFIL QISMI --}}
            {{-- Bu yerda bitta $user modelini ishlatamiz, loop kerak emas --}}
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex flex-col sm:flex-row items-center mb-4">
                    {{-- Foydalanuvchi rasmi --}}
                    {{-- Tailwind classlari rasm hajmi va shaklini boshqarish uchun --}}
                    <div class="shrink-0 mr-4"> 
                         @if ($user->image)
                            {{-- 'storage' diskida saqlangan rasmlar uchun asset('storage/' . path) ishlatiladi --}}
                            <img src="{{ asset('storage/' . $user->image->url) }}" alt="{{ $user->name }} rasmi" class="w-24 h-24 rounded-full object-cover">
                         @else
                            {{-- Default rasm. Agar default rasm public papkasida bo'lsa asset() kifoya --}}
                            <img src="{{ asset('/default-avatar.png') }}" alt="Default Rasm" class="w-24 h-24 rounded-full object-cover">
                         @endif
                    </div>

                    {{-- Foydalanuvchi ismi va username --}}
                    <div class="flex-1 text-center sm:text-left">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                        {{-- Agar username maydoni bo'lsa --}}
                        <p class="text-gray-600">{{ '@' . $user->username }}</p> 
                         {{-- Boshqa ma'lumotlar (bio, manzili va h.k.) shu yerga qo'shilishi mumkin --}}
                    </div>

                    {{-- FOLLOW/UNFOLLOW tugmasi --}}
                    {{-- Tekshiruv: joriy foydalanuvchi login bo'lganmi va profil egasi o'zi emasmi --}}
                    @if (Auth::check() && Auth::id() !== $user->id)
                        <div class="mt-4 sm:mt-0 sm:ml-auto">
                            {{-- Form action'ini to'g'rilang. users.follow nomli route mavjud deb faraz qilinadi. --}}
                            <form method="POST" action="{{ route('users.follow', $user) }}">
                                @csrf {{-- CSRF himoyasi --}}
                                @if ($isFollowing)
                                    @method('DELETE') {{-- Unfollow uchun DELETE metodidan foydalanish yaxshi amaliyot --}}
                                    <button type="submit"
                                        class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                        Unfollow
                                    </button>
                                @else
                                    <button type="submit"
                                        class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                        Follow
                                    </button>
                                @endif
                            </form>
                        </div>
                    @endif
                 </div>

                {{-- Follower, Following, Post sonlari --}}
                {{-- Controllerda loadCount orqali yuklangan --}}
                <div class="flex flex-wrap justify-center sm:justify-start space-x-4 mt-4">
                    <span class="font-semibold">{{ $user->followers_count }} Followers</span>
                    <span class="font-semibold">{{ $user->following_count }} Following</span>
                    <span class="font-semibold">{{ $user->posts_count }} Posts</span>
                </div>
            </div>

            {{-- FOYDALANUVCHI POSTLARI QISMI --}}
            <h2 class="text-2xl font-bold mb-4">{{ $user->name }}'s Posts</h2>
            
            {{-- Postlar mavjud bo'lsa, loop qilish --}}
            @if ($posts->count() > 0) 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($posts as $post)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            @if ($post->image)
                                {{-- Post rasmi uchun ham 'storage' diskini ishlating --}}
                                <img src="{{ asset('storage/' . $post->image->url) }}" alt="Post Rasmi"
                                    class="w-full h-48 object-cover rounded-lg mb-4">
                            @endif
                            <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                            {{-- Post body qismi. Str::limit yordamida cheklangan --}}
                            <p class="text-gray-700 mb-4">{{ Str::limit($post->body, 150) }}</p> 
                            {{-- Postni ko'rish uchun link --}}
                            <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                        </div>
                    @endforeach
                </div>

                {{-- Paginatsiya linklari --}}
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            @else
                {{-- Agar userning postlari bo'lmasa chiqadigan xabar --}}
                <p class="text-gray-600 text-center">{{ $user->name }} hali hech qanday post joylamagan.</p>
            @endif

        </div>
    </main>
@endsection