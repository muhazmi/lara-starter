document.addEventListener('DOMContentLoaded', function () {
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Check current theme on page load and adjust icons
    if (localStorage.getItem('color-theme') === 'dark' || 
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleDarkIcon.classList.remove('hidden');   // Show the dark icon (moon)
        themeToggleLightIcon.classList.add('hidden');     // Hide the light icon (sun)
        document.documentElement.classList.add('dark');   // Ensure the dark mode is active
    } else {
        themeToggleLightIcon.classList.remove('hidden');  // Show the light icon (sun)
        themeToggleDarkIcon.classList.add('hidden');      // Hide the dark icon (moon)
        document.documentElement.classList.remove('dark');// Ensure the light mode is active
    }

    var themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function() {
        // Toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // If dark mode is currently active, switch to light mode
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            // Otherwise, switch to dark mode
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    });
});
