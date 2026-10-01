<section id="portfolio" class="bg-white py-16">
    <div class="container mx-auto max-w-6xl px-4">
        <!-- Section Heading -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Portfolio</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Check my commercial and non commercial projects.
                <br>If you have any questions feel free to ask me for more information.
            </p>
        </div>

        <!-- Portfolio Filters -->
        <div class="flex justify-center mb-8">
            <!-- Dropdown for mobile -->
            <select id="projectFilterDropdown" class="block md:hidden w-full max-w-xs px-4 py-2 rounded-md border border-gray-300 text-sm font-medium bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-2" aria-label="Filter Projects">
                <option value="all">All Projects</option>
                <option value="web">Web Development</option>
                <option value="graphic">Graphic Design</option>
                <option value="ui">UI/UX Design</option>
            </select>
            <!-- Button group for desktop -->
            <div class="hidden md:flex flex-wrap gap-2 bg-gray-100 p-1 rounded-lg">
                <button class="filter-btn active px-4 py-2 rounded-md text-sm font-medium transition-all duration-300" data-filter="all">
                    All Projects
                </button>
                <button class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-all duration-300" data-filter="web">
                    Web Development
                </button>
                <button class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-all duration-300" data-filter="graphic">
                    Graphic Design
                </button>
                <button class="filter-btn px-4 py-2 rounded-md text-sm font-medium transition-all duration-300" data-filter="ui">
                    UI/UX Design
                </button>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">
            <!-- Web Development Projects -->
            {{-- PROJECT 1 --}}
            <div class="project-card web" data-category="web">
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-xl transition-shadow duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{  asset('img/porto/1.jpg') }}" alt="Prakata.pro" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Prakata.pro</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">PHP</span>
                            <span class="px-2 py-1 bg-cyan-100 text-cyan-800 text-xs rounded">Tailwind</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">PostgreSQL</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            A comprehensive web application for data visualization and analytics with modern UI/UX design.
                        </p>
                        <div class="flex gap-3">
                            <a href="https://prakata.pro/" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Live Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROJECT 2 --}}
            <div class="project-card web" data-category="web">
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-xl transition-shadow duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{  asset('img/porto/2.jpg') }}" alt="Kamarispa.com" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Kamarispa.com</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">PHP</span>
                            <span class="px-2 py-1 bg-cyan-100 text-cyan-800 text-xs rounded">Tailwind</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">PostgreSQL</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            E-commerce platform with advanced features and responsive design for spa services.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Live Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROJECT 3 --}}
            <div class="project-card web" data-category="web">
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-xl transition-shadow duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{  asset('img/porto/3.png') }}" alt="Jayadewataacademy.com" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Jayadewataacademy.com</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">PHP</span>
                            <span class="px-2 py-1 bg-cyan-100 text-cyan-800 text-xs rounded">Tailwind</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">PostgreSQL</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Educational platform with learning management system and interactive features.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Live Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphic Designer Projects -->
            {{-- PROJECT 1 DEISGN --}}
            <div class="project-card graphic" data-category="graphic">
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-xl transition-shadow duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{  asset('img/porto/bidan.jpg') }}" alt="Bidan Nova" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Bidan Nova</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">Photoshop</span>
                            <span class="px-2 py-1 bg-pink-100 text-pink-800 text-xs rounded">Figma</span>
                            <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">Mockup</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Complete brand identity design including logo, business cards, and marketing materials.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROJECT 2 DEISGN --}}
            <div class="project-card graphic" data-category="graphic">
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-xl transition-shadow duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{  asset('img/porto/alluneed.jpg') }}" alt="Alluneed Digital Indonesia" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Alluneed Digital Indonesia</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">Photoshop</span>
                            <span class="px-2 py-1 bg-pink-100 text-pink-800 text-xs rounded">Figma</span>
                            <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">Mockup</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Digital marketing agency branding with modern and professional design approach.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROJECT 3 DEISGN --}}
            <div class="project-card graphic" data-category="graphic">
                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full hover:shadow-xl transition-shadow duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{  asset('img/porto/waroek.jpg') }}" alt="Waroenk Ikatan Cinta" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-black px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Waroenk Ikatan Cinta</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">Photoshop</span>
                            <span class="px-2 py-1 bg-pink-100 text-pink-800 text-xs rounded">Figma</span>
                            <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">Mockup</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Restaurant branding with unique visual identity and marketing materials.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button id="loadMoreBtn" class="bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition duration-300">
                Load More Projects
            </button>
        </div>
    </div>
</section>
<script>
// Portfolio filter logic (dropdown + button group)
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const dropdown = document.getElementById('projectFilterDropdown');
    const projectCards = document.querySelectorAll('.project-card');

    function filterProjects(filter) {
        projectCards.forEach(card => {
            if (filter === 'all' || card.classList.contains(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
        // Sync button group
        filterBtns.forEach(btn => {
            if (btn.dataset.filter === filter) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
        // Sync dropdown
        if (dropdown && dropdown.value !== filter) {
            dropdown.value = filter;
        }
    }

    // Button group event
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterProjects(this.dataset.filter);
        });
    });
    // Dropdown event
    if (dropdown) {
        dropdown.addEventListener('change', function() {
            filterProjects(this.value);
        });
    }
});
</script>
