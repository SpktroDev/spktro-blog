<x-app-layout>
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{ $post->name }}</h1>
        <div class="text-lg text-gray-500 mb-2">{!! $post->extract !!}</div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Contenido principal --}}
            <div class="lg:col-span-2">
                <figure>
                    @if ($post->image)
                        <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="" />
                    @else
                        <img class="w-full h-80 object-cover object-center" src="https://cdn.pixabay.com/photo/2017/10/24/07/12/hacker-2883630_1280.jpg" alt="" />
                    @endif
                </figure>
                <div class="text-base text-gray-600 mt-4">
                    {!! $post->body !!}
                </div>
            </div>
            {{-- Contenido relacionaso --}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Mas en {{ $post->category->name }}</h1>
                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-2">
                            <a href="{{ route('posts.show', $similar) }}" class="flex text-gray-600 hover:text-gray-800">
                                @if ($similar->image)
                                    <img class="w-20 h-20 object-cover object-center mr-4" src="{{ Storage::url($similar->image->url) }}" alt="">
                                @else
                                    <img class="w-20 h-20 object-cover object-center mr-4" src="https://cdn.pixabay.com/photo/2017/10/24/07/12/hacker-2883630_1280.jpg" alt="">
                                @endif
                                <span>{{ $similar->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>
</x-app-layout>