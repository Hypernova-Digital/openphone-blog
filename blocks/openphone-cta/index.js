import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { useBlockProps, RichText } from '@wordpress/block-editor';

const { name, ...settings } = metadata;

// The themeURL passed from the PHP code is available as window.themeData.themeURL
const themeURL = window.themeData.themeURL;

registerBlockType(name, {
	...settings,

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();

		const onChangeButtonLink = (buttonLink) => {
			setAttributes({ buttonLink: buttonLink });
		};

		// onchange event for button text field
		const onChangeButtonText = (buttonText) => {
			setAttributes({ buttonText: buttonText });
		};

		// onchange event for text field
		const onChangeTitle = (title) => {
			setAttributes({ title: title });
		};

		// onchange event for description field
		const onChangeDescription = (description) => {
			setAttributes({ description: description });
		};

		return (
			<div {...blockProps}>
				<img
					src={themeURL + '/images/logo.png'}
					alt="Logo"
					className="cta-logo"
				/>
				<RichText
					tagName="h2"
					value={attributes.title}
					onChange={onChangeTitle}
					placeholder="Enter your title here"
				/>
				<RichText
					tagName="p"
					value={attributes.description}
					onChange={onChangeDescription}
					placeholder="Enter your description here"
				/>

				<RichText
					tagName="a"
					value={attributes.buttonLink}
					onChange={onChangeButtonLink}
					placeholder="Button Link"
				/>

				<RichText
					tagName="a"
					value={attributes.buttonText}
					onChange={onChangeButtonText}
					placeholder="Button Text"
				/>
			</div>
		);
	},

	save: ({ attributes }) => {
		const blockProps = useBlockProps.save();

		return (
			<div {...blockProps}>
				<img
					src={themeURL + '/images/logo.png'}
					alt="Logo"
					className="cta-logo"
				/>
				<RichText.Content tagName="h2" value={attributes.title} />
                <p>{attributes.description}</p>

				<a href={attributes.buttonLink} className="button cta-button">{attributes.buttonText}</a>
			</div>
		);
	},
});
