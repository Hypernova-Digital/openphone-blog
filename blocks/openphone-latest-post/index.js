import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	MediaUpload,
	MediaUploadCheck,
	URLInputButton,
	URLInput,
	PlainText,
} from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import metadata from './block.json';

const { name, ...settings } = metadata;

registerBlockType(name, {
	...settings,

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();

		return (
			<div
				{...blockProps}
				className="latest-post group flex cursor-pointer flex-col-reverse gap-4 md:flex-row lg:my-12 lg:gap-16"
			>
				<div className="content mx-6 sm:mx-8 sm:mt-6 md:mx-10 lg:mx-0 lg:mt-0">
					<div className="meta flex flex-row justify-start">
						<span className="flex flex-col max-w-[14rem] h-max">
							<PlainText
								className="no-underline text-[11px] no-underline sm:text-xs md:text-sm  max-w-[14rem]"
								onChange={(categoryLinkText) =>
									setAttributes({ categoryLinkText })
								}
								value={attributes.categoryLinkText}
							/>
							<URLInput
								className="max-w-[14rem]"
								value={attributes.categoryLink}
								onChange={(categoryLink) =>
									setAttributes({ categoryLink })
								}
							/>
						</span>
						<span className="opacity-10"> | </span>
						<PlainText
							className="text-[11px] opacity-70 sm:text-xs md:text-sm"
							onChange={(postDate) => setAttributes({ postDate })}
							value={attributes.postDate}
						/>
					</div>
					<a className="no-underline">
						<RichText
							tagName="h2"
							className="mb mb-0 mt-3 text-3xl leading-[1] tracking-[-0.6px] group-hover:text-purple-900 sm:mt-[14px] sm:text-[40px] md:mt-4 md:text-[56px] lg:mb-6 lg:text-6xl"
							onChange={(postTitle) =>
								setAttributes({ postTitle })
							}
							value={attributes.postTitle}
						/>
						<RichText
							tagName="p"
							className="text-base opacity-70 md:block"
							onChange={(postExcerpt) =>
								setAttributes({ postExcerpt })
							}
							value={attributes.postExcerpt}
						/>
					</a>
				</div>
				<div className="image lg:max-w-2xl">
					<URLInputButton
						url={attributes.postLink}
						onChange={(postLink) => setAttributes({ postLink })}
					/>
					<a>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) =>
									setAttributes({ postThumbnail: media.url })
								}
								allowedTypes={['image']}
								value={attributes.postThumbnail}
								render={({ open }) => (
									<Button onClick={open}>
										{!attributes.postThumbnail ? (
											'Select Image'
										) : (
											<img
												src={attributes.postThumbnail}
											/>
										)}
									</Button>
								)}
							/>
						</MediaUploadCheck>
					</a>
				</div>
			</div>
		);
	},

	save: ({ attributes }) => {
		return (
			<div className="latest-post group flex cursor-pointer flex-col-reverse gap-4 md:flex-row lg:my-12 lg:gap-16">
				<div className="content mx-6 sm:mx-8 sm:mt-6 md:mx-10 lg:mx-0 lg:mt-0">
					<div className="meta">
						<a
							href={attributes.categoryLink}
							className="no-underline [&_a]:text-[11px] [&_a]:no-underline sm:[&_a]:text-xs md:[&_a]:text-sm"
						>
							{attributes.categoryLinkText}
						</a>
						<span className="opacity-10"> | </span>
						<span className="text-[11px] opacity-70 sm:text-xs md:text-sm">
							{attributes.postDate}
						</span>
					</div>
					<a className="no-underline">
						<RichText.Content
							tagName="h2"
							className="mb mt-3 sm:mt-[14px] md:mt-4 text-3xl sm:text-[40px] md:text-[56px] lg:text-6xl tracking-[-0.6px] leading-[1] mb-0 lg:mb-6 group-hover:text-purple-900"
							value={attributes.postTitle}
						/>
						<RichText.Content
							tagName="p"
							className="text-base opacity-70 md:block"
							value={attributes.postExcerpt}
						/>
					</a>
				</div>
				<div className="image lg:max-w-2xl">
					<a href={attributes.postLink}>
						<img src={attributes.postThumbnail} className="m-0" />
					</a>
				</div>
			</div>
		);
	},
});
