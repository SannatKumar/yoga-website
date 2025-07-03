@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; margin-bottom:2rem;">Yoga Videos</h1>
    <style>
        .video-controls {
            max-width: 900px;
            margin: 0 auto 1.5rem auto;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: space-between;
            align-items: center;
        }
        .video-controls input[type="text"] {
            flex: 1 1 200px;
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .filter-btns {
            display: flex;
            gap: 0.5rem;
        }
        .filter-btns button {
            background: #f3f1ff;
            color: #6c63ff;
            border: 1px solid #6c63ff;
            border-radius: 5px;
            padding: 0.4rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .filter-btns button.active, .filter-btns button:hover {
            background: #6c63ff;
            color: #fff;
        }
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
            max-width: 1000px;
            margin: 0 auto 2rem auto;
        }
        .video-card {
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s;
        }
        .video-card:hover {
            box-shadow: 0 4px 16px rgba(108,99,255,0.13);
        }
        .video-thumb {
            width: 100%;
            height: 160px;
            object-fit: cover;
            background: #ddd;
        }
        .video-info {
            padding: 1rem;
            flex: 1 1 auto;
        }
        .video-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #6c63ff;
            margin-bottom: 0.5rem;
        }
        .video-desc {
            color: #444;
            font-size: 0.98rem;
            margin-bottom: 0.5rem;
        }
        .video-tags {
            margin-bottom: 0.5rem;
        }
        .video-tag {
            display: inline-block;
            background: #e0e7ff;
            color: #554ee2;
            border-radius: 3px;
            padding: 0.15rem 0.6rem;
            font-size: 0.85rem;
            margin-right: 0.3rem;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        .pagination button {
            background: #f3f1ff;
            color: #6c63ff;
            border: 1px solid #6c63ff;
            border-radius: 5px;
            padding: 0.4rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .pagination button.active, .pagination button:hover {
            background: #6c63ff;
            color: #fff;
        }
    </style>
    <div class="video-controls">
        <input type="text" id="video-search" placeholder="Search videos..." oninput="filterVideos()">
        <div class="filter-btns">
            <button class="active" onclick="filterByTag('all', this)">All</button>
            <button onclick="filterByTag('Beginner', this)">Beginner</button>
            <button onclick="filterByTag('Hatha', this)">Hatha</button>
            <button onclick="filterByTag('Vinyasa', this)">Vinyasa</button>
            <button onclick="filterByTag('Meditation', this)">Meditation</button>
        </div>
    </div>
    <div class="videos-grid" id="videos-grid">
        <!-- Videos will be rendered here by JS -->
    </div>
    <div class="pagination" id="pagination">
        <!-- Pagination will be rendered here by JS -->
    </div>
    <script>
        // Sample video data
        const videos = [
            {
                id: '1',
                youtube: 'v7AYKMP6rOE',
                title: 'Beginner Yoga Flow',
                desc: 'A gentle yoga flow for beginners to start your journey.',
                tags: ['Beginner', 'Hatha']
            },
            {
                id: '2',
                youtube: '4pKly2JojMw',
                title: 'Morning Vinyasa Routine',
                desc: 'Energize your day with this morning vinyasa sequence.',
                tags: ['Vinyasa']
            },
            {
                id: '3',
                youtube: 'dF7O6-QabIo',
                title: 'Yoga for Flexibility',
                desc: 'Improve your flexibility with these essential yoga poses.',
                tags: ['Beginner', 'Hatha']
            },
            {
                id: '4',
                youtube: 'inpok4MKVLM',
                title: 'Guided Meditation',
                desc: 'Relax and unwind with this guided meditation session.',
                tags: ['Meditation']
            },
            {
                id: '5',
                youtube: 'X3-gKPNyrTA',
                title: 'Power Vinyasa Flow',
                desc: 'A dynamic vinyasa flow for strength and stamina.',
                tags: ['Vinyasa']
            },
            {
                id: '6',
                youtube: 'oBu-pQG6sTY',
                title: 'Evening Yoga to Unwind',
                desc: 'A calming yoga routine to help you relax in the evening.',
                tags: ['Hatha']
            },
            // Add more videos as needed
        ];
        let filteredVideos = videos;
        let currentTag = 'all';
        let currentPage = 1;
        const perPage = 4;

        function renderVideos() {
            const grid = document.getElementById('videos-grid');
            grid.innerHTML = '';
            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            const pageVideos = filteredVideos.slice(start, end);
            if (pageVideos.length === 0) {
                grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;color:#888;">No videos found.</div>';
                return;
            }
            pageVideos.forEach(video => {
                const tagsHtml = video.tags.map(tag => `<span class='video-tag'>${tag}</span>`).join(' ');
                grid.innerHTML += `
                    <div class="video-card">
                        <a href="https://www.youtube.com/watch?v=${video.youtube}" target="_blank" rel="noopener">
                            <img class="video-thumb" src="https://img.youtube.com/vi/${video.youtube}/hqdefault.jpg" alt="${video.title}">
                        </a>
                        <div class="video-info">
                            <div class="video-title">${video.title}</div>
                            <div class="video-desc">${video.desc}</div>
                            <div class="video-tags">${tagsHtml}</div>
                        </div>
                    </div>
                `;
            });
        }

        function renderPagination() {
            const pag = document.getElementById('pagination');
            pag.innerHTML = '';
            const totalPages = Math.ceil(filteredVideos.length / perPage);
            if (totalPages <= 1) return;
            for (let i = 1; i <= totalPages; i++) {
                pag.innerHTML += `<button class="${i === currentPage ? 'active' : ''}" onclick="gotoPage(${i})">${i}</button>`;
            }
        }

        function filterVideos() {
            const search = document.getElementById('video-search').value.toLowerCase();
            filteredVideos = videos.filter(v => {
                const matchesTag = currentTag === 'all' || v.tags.includes(currentTag);
                const matchesSearch = v.title.toLowerCase().includes(search) || v.desc.toLowerCase().includes(search);
                return matchesTag && matchesSearch;
            });
            currentPage = 1;
            renderVideos();
            renderPagination();
        }

        function filterByTag(tag, btn) {
            currentTag = tag;
            document.querySelectorAll('.filter-btns button').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterVideos();
        }

        function gotoPage(page) {
            currentPage = page;
            renderVideos();
            renderPagination();
        }

        // Initial render
        filterVideos();
    </script>
@endsection 