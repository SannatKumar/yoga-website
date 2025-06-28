<header class="w-full bg-[#1B4D3F] text-white py-4 px-6 mb-6">
    <nav class="flex items-center justify-between gap-4 mb-2">
        <div class="flex gap-6">
            <a href="/" class="font-semibold {{ request()->is('/') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">Home</a>
            <a href="/gallery" class="font-semibold {{ request()->is('gallery*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">Gallery</a>
            <a href="/info" class="font-semibold {{ request()->is('info*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">Info</a>
            <a href="/videos" class="font-semibold {{ request()->is('videos*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">Videos</a>
            <a href="/contact" class="font-semibold {{ request()->is('contact*') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }} hover:underline transition-colors">Contact Us</a>
        </div>
    </nav>
</header> 