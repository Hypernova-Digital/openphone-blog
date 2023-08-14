import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { SelectControl, Button } from '@wordpress/components';

const { name, ...settings } = metadata;

const themeURL = window.themeData.themeURL; // The themeURL passed from the PHP code is available as window.themeData.themeURL

registerBlockType(name, {
	...settings,

	attributes: {
		...settings.attributes,
		imageUrl: {
			type: 'string',
			default: '',
		},
		buttonStyle: {
			type: 'string',
			default: 'button cta-button',
		},
	},

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();

		const onChangeButtonLink = (buttonLink) => {
			setAttributes({ buttonLink: buttonLink });
		};

		const onChangeButtonText = (buttonText) => {
			setAttributes({ buttonText: buttonText });
		};

		const onChangeTitle = (title) => {
			setAttributes({ title: title });
		};

		const onChangeDescription = (description) => {
			setAttributes({ description: description });
		};

		const onChangeBgColor = (newColor) => {
			setAttributes({ bgColor: newColor });
		};

		const onImageSelect = (media) => {
			setAttributes({ imageUrl: media.url });
		};

		const onRemoveImage = () => {
			setAttributes({ imageUrl: '' });
		};

		const onChangeButtonStyle = (newStyle) => {
			setAttributes({ buttonStyle: newStyle });
		};

		return (
			<>
				<InspectorControls>
					<SelectControl
						label="Background Color"
						value={attributes.bgColor}
						options={[
							{ label: 'Purple', value: 'bg-purple-50' },
							{ label: 'Red', value: 'bg-red-50' },
							{ label: 'Green', value: 'bg-green-50' },
							{ label: 'Blue', value: 'bg-blue-50' },
							{ label: 'Yellow', value: 'bg-yellow-50' },
							{ label: 'Orange', value: 'bg-orange-50' },
						]}
						onChange={onChangeBgColor}
					/>
					<SelectControl
						label="Button Style"
						value={attributes.buttonStyle}
						options={[
							{ label: 'Default', value: 'button cta-button' },
							{ label: 'Black', value: 'button cta-button button-black' },
						]}
						onChange={onChangeButtonStyle}
					/>
				</InspectorControls>
				<div
					{...blockProps}
					className={`${blockProps.className} ${attributes.bgColor}`}
				>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={onImageSelect}
							allowedTypes={['image']}
							value={attributes.imageUrl}
							render={({ open }) => (
								<Button onClick={open}>
									{ ! attributes.imageUrl ? (
										'Upload Image'
									) : (
										<>
											<img
												src={attributes.imageUrl}
												alt="Logo"
												className="cta-logo mx-auto"
											/>
											<Button onClick={onRemoveImage}>Remove Image</Button>
										</>
									) }
								</Button>
							)}
						/>
					</MediaUploadCheck>
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
			</>
		);
	},

	save: ({ attributes }) => {
		const blockProps = useBlockProps.save();

		return (
			<div
				{...blockProps}
				className={`${blockProps.className} ${attributes.bgColor}`}
			>
				{attributes.imageUrl && (
					<img
						src={attributes.imageUrl || themeURL + '/images/logo.png'}
						alt="Logo"
						className="cta-logo"
					/>
				)}
				<RichText.Content tagName="h2" value={attributes.title} />
				<RichText.Content tagName="p" value={attributes.description} />

				<a href={attributes.buttonLink} className={attributes.buttonStyle}>
					{attributes.buttonText}
				</a>
			</div>
		);
	},
});
