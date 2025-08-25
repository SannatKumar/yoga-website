@props([
    'title' => '',
    'excerpt' => '',
    'href' => '#',
    'image' => null,
])

<article class="bg-white rounded-2xl shadow hover:shadow-md transition p-4 flex flex-col h-80">
    @if($image)
        <div class="h-28 w-full overflow-hidden rounded-lg mb-3">
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
        </div>
    @endif
    <h3 class="text-xl font-semibold text-gray-800">{{ $title }}</h3>
    <p class="text-gray-600 mt-2 mb-4 line-clamp-3">{{ $excerpt }}</p>
    <div class="mt-auto">
        <a href="{{ $href }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md transition">Read more</a>
    </div>
</article>

<style>
/* Fallback for line clamp if Tailwind plugin not active */
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

