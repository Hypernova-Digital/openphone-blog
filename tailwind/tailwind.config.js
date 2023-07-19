// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
		// Uncomment below to add additional first-party Tailwind plugins.
		require('@tailwindcss/forms'),
		require('@tailwindcss/aspect-ratio'),
		require('@tailwindcss/container-queries'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
		'./theme/theme.json',
	],
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			colors: {
				transparent: 'transparent',
				current: 'currentColor',
				purple: {
					25: '#F7F5FE',
					50: '#F0ECFE',
					100: '#cffafe',
					200: '#a5f3fc',
					300: '#67e8f9',
					400: '#22d3ee',
					500: '#06b6d4',
					600: '#0891b2',
					700: '#0e7490',
					800: '#155e75',
					900: '#6439F5',
					1400: '#190E3D',
				},
				violet: {
					50: '#F4EEFF',
				},
			},
			maxWidth: {
				'7xl': '1200px',
			},
			boxShadow: {
				'default': '4px 4px 0px 0px #000',
			  },
			keyframes: {
				slideDown: {
					'0%': {
						transform: 'translateY(-100%)',
					},
					'100%': {
						transform: 'translateY(0)',
					}
				}
			},
			animation: {
				slideDown: 'slideDown 0.35s',
			}
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson')(require('../theme/theme.json')),

		// Add Tailwind Typography.
		require('@tailwindcss/typography'),

		function ({ addComponents }) {
			addComponents({
				'.container': {
					maxWidth: '100%',
					'@screen sm': {
						maxWidth: '568px',
					},
					'@screen md': {
						maxWidth: '880px',
					},
					'@screen lg': {
						maxWidth: '1200px',
					},
					'@screen xl': {
						maxWidth: '2400px',
					},
				},
			});
		},
	],
};
