<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
    <nav class="flex items-center justify-between gap-4 mb-2">
        <div class="flex gap-6">
            <a href="/" class="font-semibold {{ request()->is('/') ? 'text-[#F53003]' : 'text-[#1b1b18] hover:text-[#F53003]' }} hover:underline">Home</a>
            <a href="/gallery" class="font-semibold {{ request()->is('gallery*') ? 'text-[#F53003]' : 'text-[#1b1b18] hover:text-[#F53003]' }} hover:underline">Gallery</a>
            <a href="/info" class="font-semibold {{ request()->is('info*') ? 'text-[#F53003]' : 'text-[#1b1b18] hover:text-[#F53003]' }} hover:underline">Info</a>
            <a href="/videos" class="font-semibold {{ request()->is('videos*') ? 'text-[#F53003]' : 'text-[#1b1b18] hover:text-[#F53003]' }} hover:underline">Videos</a>
            <a href="/contact" class="font-semibold {{ request()->is('contact*') ? 'text-[#F53003]' : 'text-[#1b1b18] hover:text-[#F53003]' }} hover:underline">Contact Us</a>
        </div>
    </nav>
</header> 