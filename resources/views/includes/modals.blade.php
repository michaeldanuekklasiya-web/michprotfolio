<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6 relative">
            <!-- Close Button -->
            <button id="closeContactModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Get In Touch</h3>
                <p class="text-gray-600">Let's discuss your project and bring your ideas to life.</p>
            </div>

            <!-- Contact Form -->
            <form id="contactForm" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" id="name" name="name" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Your name">
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="your@email.com">
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" id="subject" name="subject" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Project type">
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" name="message" rows="4" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Tell me about your project..."></textarea>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>

                <button type="submit" 
                        class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition duration-300 flex items-center justify-center">
                    <span class="submit-text">Send Message</span>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" id="loadingSpinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <!-- Success Message -->
            <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                <p>Thank you for your message! I'll get back to you soon.</p>
            </div>
        </div>
    </div>
</div>

<!-- Dark Mode Toggle -->
<div id="darkModeToggle" class="fixed top-4 right-4 z-40">
    <button class="bg-white dark:bg-gray-800 p-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" id="sunIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <svg class="w-6 h-6 text-gray-800 dark:text-white hidden" id="moonIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
    </button>
</div>
