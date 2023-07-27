import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { useBlockProps, MediaUpload } from '@wordpress/block-editor';
const { name, ...settings } = metadata;

registerBlockType(name, {
	...settings,

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();

		// Set attributes functions
		const setImage = (value) => {
			setAttributes({ image: value });
		};

		const setLink = (value) => {
			setAttributes({ link: value });
		};

		const setTitle = (value) => {
			setAttributes({ title: value });
		};

		const setTagline = (value) => {
			setAttributes({ tagline: value });
		};

		return (
			<div {...blockProps} className="flex flex-col justify-center gap-4">
				<div className="flex flex-row w-full">
					<input
						type="text"
						value={attributes.link}
						placeholder="Link URL"
						onChange={(event) => setLink(event.target.value)}
						className="mb-4 w-full"
					/>
				</div>

				<div className="flex w-full flex-row items-center justify-between">
					<MediaUpload
						onSelect={(media) => setImage(media.url)}
						value={attributes.image}
						render={({ open }) => (
							<button onClick={open} className="w-1/3">
								{attributes.image ? (
									<img
										src={attributes.image}
										alt="Featured Resource Image"
										style={{ maxWidth: '100%' }}
									/>
								) : (
									'Upload Image'
								)}
							</button>
						)}
					/>
					<input
						type="text"
						value={attributes.title}
						placeholder="Title"
						onChange={(event) => setTitle(event.target.value)}
						className="w-1/3"
					/>

					<input
						type="text"
						value={attributes.tagline}
						placeholder="Tagline"
						className="w-1/3"
						onChange={(event) => setTagline(event.target.value)}
					/>
				</div>
			</div>
		);
	},

	save: ({ attributes }) => {
		return (
			<div className="featured-resource-block">
				{attributes.image && (
					<a
						href={attributes.link}
						target="_blank"
						rel="noopener noreferrer" 
                        className="flex flex-row items-center justify-between w-full"
					>
						<img
							src={attributes.image}
							alt="Featured Resource Image"
							style={{ maxWidth: '100%' }}
                            className="flex-none"
						/>

						<div className="flex flex-col justify-between grow w-full">
							<h2 className="font-semibold leading-[1.2] tracking-[-0.8px]">{attributes.title}</h2>
							<p className="text-sm opacity-70">{attributes.tagline}</p>
                            <span className="text-base font-medium">Browse posts -> </span>
						</div>
					</a>
				)}
			</div>
		);
	},
});
