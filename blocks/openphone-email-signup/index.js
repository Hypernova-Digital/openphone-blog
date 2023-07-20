import { subscribe, useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { TextControl } from '@wordpress/components';
import { useBlockProps } from '@wordpress/block-editor';

const { name, ...settings } = metadata;

registerBlockType(name, {
	...settings,

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();

		const updateFieldValue = (textField) => {
			setAttributes({ content: textField });
		};

		const updateSubscribeText = (subscribeText) => {
			setAttributes({ subscribeText: subscribeText });
		};

		const updateHeadingText = (headingText) => {
			setAttributes({ headingText: headingText });
		};

		const updateButtonText = (buttonText) => {
			setAttributes({ buttonText: buttonText });
		};

		return (
			<div {...blockProps}>
				<TextControl
					label="Heading Text"
					value={attributes.headingText}
					onChange={updateHeadingText}
				/>
				<TextControl
					label="Subscribe Text"
					value={attributes.subscribeText}
					onChange={updateSubscribeText}
				/>
				<TextControl
					label="Placeholder Text"
					value={attributes.content}
					onChange={updateFieldValue}
				/>
				<TextControl
					label="Placeholder Text"
					value={attributes.buttonText}
					onChange={updateFieldValue}
				/>
			</div>
		);
	},

	save: ({ attributes }) => {
		const blockProps = useBlockProps.save({
			className: 'openphone-email-signup mx-0 bg-purple-50 p-4',
			style: 'max-width: 100%;',
		});

		return (
			<div {...blockProps}>
				<div className="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-32 flex flex-col md:flex-row items-center">
					<h2 className="m-0 text-3xl tracking-[-0.6px] leading-[1] font-bold text-black">
						{attributes.headingText}
					</h2>

					<div>
						<span className="block mb-4 text-black opacity-70">
							{attributes.subscribeText}
						</span>
						<form className="mt-4 flex flex-col md:flex-row">
							<input
								type="email"
								id="email"
								name="email"
								placeholder={attributes.content}
								className="rounded-lg border border-black bg-white placeholder:text-slate-400 w-ful"
								style="border-radius: 8px;padding-top: 0.5rem;padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem; margin-right: 1rem;"
							/>
							<button
								className="bg-purple-900 px-4 py-2 text-white mt-4 lg:mt-0"
								style="border-radius: 10px;padding-top: 0.5rem;padding-bottom: 0.5rem; padding-left: 1rem; padding-right: 1rem;"
							>
								{attributes.buttonText}
							</button>
						</form>
					</div>
				</div>
			</div>
		);
	},
});
