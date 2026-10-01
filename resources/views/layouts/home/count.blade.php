<!-- Stats/Counter Section -->
<section id="stats" class="bg-white py-12 md:py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between items-center text-center">
            <!-- Projects Completed -->
            <div class="w-1/2 md:w-1/4 mb-8 md:mb-0">
                <div class="flex flex-col items-center">
                    <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-1 counter" data-target="200">0</h3>
                    <p class="text-xs uppercase tracking-wider text-gray-500">PROJECTS COMPLETED</p>
                </div>
            </div>

            <!-- Design Awards -->
            <div class="w-1/2 md:w-1/4 mb-8 md:mb-0">
                <div class="flex flex-col items-center">
                    <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-1 counter" data-target="12">0</h3>
                    <p class="text-xs uppercase tracking-wider text-gray-500">DESIGN AWARDS</p>
                </div>
            </div>

            <!-- Years Experience -->
            <div class="w-1/2 md:w-1/4">
                <div class="flex flex-col items-center">
                    <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-1 counter" data-target="10">0</h3>
                    <p class="text-xs uppercase tracking-wider text-gray-500">YEARS EXPERIENCE</p>
                </div>
            </div>

            <!-- Happy Clients -->
            <div class="w-1/2 md:w-1/4">
                <div class="flex flex-col items-center">
                    <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mb-1 counter" data-target="72">0</h3>
                    <p class="text-xs uppercase tracking-wider text-gray-500">HAPPY CLIENTS</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript to animate the counter -->
<script>
    // Detect when section is in view
    const counters = document.querySelectorAll('.counter');

    function animateCounters() {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'), 10);
            let count = 0;
            const interval = setInterval(() => {
                count += Math.ceil(target / 100); // Increment the count
                counter.textContent = count;
                if (count >= target) {
                    clearInterval(interval);
                    counter.textContent = target; // Ensure we reach the target
                }
            }, 10);
        });
    }

    // Listen for scroll event to trigger animation
    function checkVisibility() {
        const statsSection = document.getElementById('stats');
        const rect = statsSection.getBoundingClientRect();
        if (rect.top <= window.innerHeight && rect.bottom >= 0) {
            animateCounters();
            window.removeEventListener('scroll', checkVisibility); // Run only once
        }
    }

    // On page load, check if the section is in view
    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // Initial check in case section is already visible
</script>

<style>
    .counter {
        transition: all 1s ease-in-out; /* Smooth transition for counting */
    }
</style>
