/**
 * The JavaScript code you place here will be processed by esbuild, and the
 * output file will be created at `../theme/js/script.min.js` and enqueued by
 * default in `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */


document.addEventListener("DOMContentLoaded", () => {
    const applyMobileCode = () => {
        document.body.classList.add('mobile');
    }
    
    const removeMobileCode = () => {
        document.body.classList.remove('mobile');
    }

    if (window.innerWidth < 768) {
        applyMobileCode();
    }
    
    window.addEventListener('resize', () => {
        if (window.innerWidth < 768) {
            applyMobileCode();
        } else {
            removeMobileCode();
        }
    });

    const footers = document.querySelectorAll('.mobile footer h2');
    footers.forEach(footer => {
        footer.addEventListener('click', (e) => {
            const aside = e.target.closest('aside');
            if (aside) aside.classList.toggle('active');
        });
    });
});
