document.addEventListener('DOMContentLoaded', function() {
	/* The code to make the scroll progress bar visible is in `script.js`, this allows us to hide the progress bar
	 * until the header becomes sticky.
	 */
	const scrollProgressValue = document.querySelector('.scroll-progress-value');
	const scrollProgressBar = document.querySelector('.scroll-progress-bar');
	const pageHeader = document.getElementById('masthead');
	const scrollProgressHandler = () => {
		const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
		const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		const scrolled = (winScroll / height) * 100;

		scrollProgressValue.style.width = scrolled + '%';

		// Only show the scroll progress bar if the header is sticky
		const headerIsSticky = pageHeader.classList.contains('sticky-nav');
		scrollProgressBar.classList.toggle('hidden', !headerIsSticky);

	}

	window.addEventListener('scroll', scrollProgressHandler, {passive: true});
});
