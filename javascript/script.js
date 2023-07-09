/**
 * The JavaScript code you place here will be processed by esbuild, and the
 * output file will be created at `../theme/js/script.min.js` and enqueued by
 * default in `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

// Config

// Set this to false before shipping
const DEBUG = true;

const mobileMediaQuery = '(max-width: 767px)';
// The media query used to determine if the page is mobile, if this matches, the `mobileClass` will be applied to the `mobileClassTargetSelector`

const mobileClass = ['mobile'];
// One or more classes to apply to the body when the page is mobile, they will automatically be removed if the page is not mobile

const mobileTocHiddenByDefault = true;
// Whether the table of contents should be hidden by default on mobile

// ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐
// @Mira: Here are the classes that will be toggled on the toc element (or `mobileTocVisibilityClassTarget`) to show/hide the toc entries
// @Mira: You can change these if you want, but make sure they match the CSS
const mobileTocVisibilityClass = ['toc-expanded', 'visible'];
// Mobile: These classes will be toggled on the toc element (or `mobileTocVisibilityClassTarget`) to hide the toc entries

const mobileTocHiddenClass = ['toc-hidden', 'hidden'];
// Mobile: These classes will the toggled on the toc element (or `mobileTocVisibilityClassTarget`) to hide the toc entries

// Desktop: The classes to apply to the active toc entry (the anchor of the nearest header)
const desktopActiveTocEntryClass = ['active']; // the class applied to the anchor of the current toc entry

// Mobile: The selector of the element the user clicks to show/hide the toc
const tocExpandSelector = '#toc-expand'
// Mobile: The classes to add to the toc element (and/or `mobileTocVisibilityClassTarget`) when the toc is visible

// Mobile: The text for the button when the toc is visible
const tocVisibleText = 'Hide -';
// Mobile: The text for the button when the toc is hidden
const tocHiddenText = 'Show +';

// All: Whether to remove the related posts section from the toc
const removeRelatedPosts = true;

// @Mira: put whatever HTML you want in here, just makes sure that:
// 1. #toc-expand should be the id on whatever you click to show the table of contents
// 2. .show-toc is applied to the body when the table of contents is shown on mobile
// 3. .mobile-header is hidden when `mobile` class is not on the body
// 4. .lwptoc should be hidden in all cases (the OG toc)

// This is the HTML that will be inserted into the DOM, inside a div with the id `open-phone-toc`
const tocHTMLTemplate = `
<div class="mobile-header">
	<h1>Table of contents</h1>
	<span id="toc-expand">Show +</span>
</div>
<!-- Safe to remove: TOC entries will be appended below -->
`;
// ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐

// You shouldn't need any of this hopefully, but, it's good to be aware of it:

// Mobile: The selector of the element to append the toc to
const mobileTocTargetSelector = 'header.entry-header';
// Desktop: The selector of the element to insert the toc after
const desktopTocTargetSelector = 'header.entry-header';

// All: The selector of the toc anchors/entries we'll be cloning from the original toc
const tocEntrySelector = '.lwptoc_item > a';

// All: The selector for headers
const headerSelector = '.wp-block-heading';

// @Mira: If you need to toggle the classes on a different element, you can use these options:
const mobileTocVisibilityClassTarget  = null;
// Optional Override: A selector of an additional element to toggle `mobileTocVisibilityClass` on (in addition to the toc element)

const mobileClassTargetSelector = null;
//  Optional Override: The selector of an additional element to apply the `mobileClass` to (in addition to document.body)

const mobileMediaQueryList = window.matchMedia(mobileMediaQuery);
const isMobile = () => mobileMediaQueryList.matches;

const createToc = (anchors) => {
	const toc = document.createElement('div');
	toc.id = 'open-phone-toc';
	toc.innerHTML = tocHTMLTemplate;

	anchors.forEach(item => {
		const text = item.textContent.trim().toLowerCase();
		if (removeRelatedPosts && text.includes('related posts:')) return; // Exclude the related posts section
		toc.appendChild(item.cloneNode(true));
	});

	return toc;
}
const appendTocToHeader = (toc) => {
	const header = document.querySelector(isMobile() ? mobileTocTargetSelector : desktopTocTargetSelector);
	if (isMobile()) {
		// Append TOC to the header on mobile, it'll be the last child in the `mobileTocTargetSelector`
		header && header.appendChild(toc);
	} else { // Desktop
		// Place the TOC after the `desktopTocTargetSelector`
		header && header.after(toc);
	}
}

// Toggle multiple classes on an element, if `force` is true, the classes will be added, if false, they'll be removed
const toggleClasses = (el, force, ...args) => {
	if (!el) return
	DEBUG && console.log('toggleClasses: start ', { el, force, args });
	if (typeof force !== 'boolean') {
		args.unshift(force);
		force = undefined;
	}
	const result = args.map(e => el.classList.toggle(e, force))
	DEBUG && console.log('toggleClasses: end ', { el, force, args, result, classList: el.classList });
}
document.addEventListener("DOMContentLoaded", () => {
	let toc; // The table of contents element
	let intersectionObserver; // Used on desktop to observe the headers and update the active toc entry

	// If the table of contents is non-empty, we'll clone its anchors and append it to (or after) the header
	const anchors = document.querySelectorAll(tocEntrySelector);
	const hasTableOfContents = anchors && anchors.length > 0;

	// This function toggles the visibility of the toc on mobile, to set the visibility pass a boolean whether it should be visible or not
	const toggleToc = (force) => {
		const isVisible = mobileTocVisibilityClass.some(e => toc.classList.contains(e));

		// Toggle the visibility of the toc, allowing the force to be passed in, if not passed, it'll toggle the visibility
		if (typeof force !== 'boolean') {
			force = !isVisible;
		}

		// Add or remove classes based on the 'force' variable
		if (force) { // visible
			mobileTocVisibilityClass.forEach(cls => toc.classList.add(cls));
			mobileTocHiddenClass.forEach(cls => toc.classList.remove(cls));
			// If we don't use `mobileTocVisibilityClassTarget` we can remove this block
			if (mobileTocVisibilityClassTarget) {
				const target = document.querySelector(mobileTocVisibilityClassTarget);
				if (target) {
					mobileTocVisibilityClass.forEach(cls => target.classList.add(cls));
					mobileTocHiddenClass.forEach(cls => target.classList.remove(cls));
				}
			}
		} else { // hidden
			mobileTocVisibilityClass.forEach(cls => toc.classList.remove(cls));
			mobileTocHiddenClass.forEach(cls => toc.classList.add(cls));
			// If we don't use `mobileTocVisibilityClassTarget` we can remove this block
			if (mobileTocVisibilityClassTarget) {
				const target = document.querySelector(mobileTocVisibilityClassTarget);
				if (target) {
					mobileTocVisibilityClass.forEach(cls => toc.classList.remove(cls));
					mobileTocHiddenClass.forEach(cls => toc.classList.add(cls));
				}
			}
		}

		const buttonElement = document.querySelector(tocExpandSelector);
		buttonElement && (buttonElement.textContent = force ? tocHiddenText : tocVisibleText);
	}

	// Observe the headers on desktop, and update the active toc entry
	const observeHeaders = () => {
		intersectionObserver = intersectionObserver || new IntersectionObserver((entries) => {
			// Filter the entries for those that are intersecting.
			const intersectingEntries = entries.filter(entry => entry.isIntersecting);

			if (intersectingEntries.length === 0) {
				return;
			}

			// Sort the entries by their distance from the top of the viewport and select the closest one.
			intersectingEntries.sort((a, b) => a.target.getBoundingClientRect().top - b.target.getBoundingClientRect().top);
			const closestEntry = intersectingEntries[0];

			// Remove the active class from all TOC entries.
			toc.querySelectorAll(`.${desktopActiveTocEntryClass.join(' ')}`).forEach(el => el.classList.remove(...desktopActiveTocEntryClass));

			// Set the active class on the TOC entry corresponding to the closest header.
			const id = closestEntry.target.children[0].id;
			const tocEntry = toc.querySelector(`a[href="#${id}"]`);
			tocEntry.classList.add(...desktopActiveTocEntryClass);
		}, { root: null, threshold: 1, rootMargin: '0px 0px -50% 0px' });

		document.querySelectorAll(headerSelector).forEach((header) => {
			const id = header.children[0].id;
			const tocEntry = toc.querySelector(`a[href="#${id}"]`);
			const text = header.textContent.trim().toLowerCase();
			if (removeRelatedPosts && text.includes('related posts:')) return; // Exclude the related posts section
			if (!tocEntry) return; // Don't observe headers that aren't in the toc
			tocEntry.addEventListener('click', () => {
				toc.querySelector(`.${desktopActiveTocEntryClass.join(' ')}`).classList.remove(...desktopActiveTocEntryClass);
				tocEntry.classList.add(...desktopActiveTocEntryClass);
			});
			intersectionObserver.observe(header);
		});
	}

	// Unobserve the headers on mobile
	const unobserveHeaders = () => {
		if (!intersectionObserver) return
		document.querySelectorAll(headerSelector).forEach((header) => {
			intersectionObserver.unobserve(header);
		});
	}
	// Called when the media query match changes and on page load
	const initializeToc = () => {
		toc = toc || createToc(anchors);
		// Create toc if it doesn't exist, re-use if it does

		appendTocToHeader(toc);
		// Append the toc before/after the header

		// Toggle `mobileClass` on document.body whenever the media query matches
		toggleClasses(document.body, isMobile(), ...mobileClass)

		if (isMobile()) {
			toggleToc(mobileTocHiddenByDefault);
			// Use the `mobileTocHiddenByDefault` config to determine if the toc should be hidden by default
			unobserveHeaders();
			// Unobserve the headers on mobile
		} else { // Desktop
			// Force the toc entries visible incase they were hidden on mobile
			toggleToc(true);
			observeHeaders();
			// Observe the headers on desktop
		}

		if (mobileClassTargetSelector) {
			// Toggle `mobileClass` on `mobileClassTargetSelector` whenever the media query matches
			const mobileClassTargetElement = document.querySelector(mobileTocTargetSelector);
			toggleClasses(mobileClassTargetElement, isMobile(), ...mobileClass)
		}
	}

	if (hasTableOfContents) {
		// Update the body class and move the toc on resize (mobile <-> desktop)
		mobileMediaQueryList.addEventListener('change', initializeToc);

		// Call initially on page load
		initializeToc();

		// Toggle toc visibility on mobile when the user clicks the toc expand button (`tocExpandSelector`)
		document.querySelector(tocExpandSelector).addEventListener('click', toggleToc);
	}

	const footers = document.querySelectorAll('.mobile footer h2');
	footers.forEach(footer => {
		footer.addEventListener('click', (e) => {
			const aside = e.target.closest('aside');
			if (aside) aside.classList.toggle('active');
		});
	});
});