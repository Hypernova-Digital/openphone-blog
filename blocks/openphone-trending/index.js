import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import {
	useBlockProps,
	RichText,
	MediaUpload,
	URLInput,
	InnerBlocks,
} from '@wordpress/block-editor';
import { TextControl, Button } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const { name, ...settings } = metadata;

registerBlockType(name, {
	...settings,

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const { title, cards, tags } = attributes;
		const blockProps = useBlockProps();

		const onChangeTitle = (title) => {
			setAttributes({ title: title });
		};

		const onChangeCard = (index, attribute, value) => {
			const newCards = [...cards];
			newCards[index][attribute] = value;
			setAttributes({ cards: newCards });
		};

		const addCard = () => {
			const newCards = [...cards, { img: '', text: '', link: '' }];
			setAttributes({ cards: newCards });
		};

		const onChangeTag = (index, field, value) => {
			const newTags = [...tags];
			newTags[index] = { ...newTags[index], [field]: value };
			setAttributes({ tags: newTags });
		};

		const addTag = () => {
			const newTags = [...tags, { text: '', tagLink: '' }];
			setAttributes({ tags: newTags });
		};

		return (
			<div {...blockProps}>
				<TextControl
					label="Heading Text"
					value={title}
					onChange={onChangeTitle}
				/>
				{cards.map((card, index) => (
					<Fragment key={index}>
						<MediaUpload
							onSelect={(media) =>
								onChangeCard(index, 'img', media.url)
							}
							type="image"
							value={card.img}
							render={({ open }) => (
								<Button onClick={open}>Upload Image</Button>
							)}
						/>
						<RichText
							tagName="h4"
							onChange={(text) =>
								onChangeCard(index, 'text', text)
							}
							value={card.text}
						/>
						<URLInput
							value={card.link}
							onChange={(link) =>
								onChangeCard(index, 'link', link)
							}
						/>
					</Fragment>
				))}
				<Button onClick={addCard}>Add Card</Button>
				{tags.map((tag, index) => (
					<Fragment key={index}>
						<TextControl
							label="Tag"
							value={tag.text}
							onChange={(text) => onChangeTag(index, 'text', text)}
						/>
						<URLInput
							label="Tag Link"
							value={tag.tagLink}
							onChange={(link) => onChangeTag(index, 'tagLink', link)}
						/>
					</Fragment>
				))}
				<Button onClick={addTag}>Add Tag</Button>
			</div>
		);
	},

	save: ({ attributes }) => {
		const { title, cards, tags } = attributes;

		return (
			<div className="trending-block w-full bg-[#190E3D] text-white">
				<div className="container mx-auto px-6 xl:w-[1200px]">
					<h2 className="text-center">{title}</h2>

					<div className="trending-block-cards">
						{cards.map((card, index) => (
							<div key={index} className="trending-block-card">
								<a
									href={card.link}
									className="trending-block-link"
								>
									<img src={card.img} alt={card.text} />
									<h4>{card.text}</h4>
								</a>
							</div>
						))}
					</div>
					<div className="trending-block-tags">
						<span className="tag-title">All topics:</span>

						<div className="tags">
							{tags.map((tag, index) => (
								<a key={index} href={tag.tagLink} className="tag text-white hover:text-white visited:text-whtie no-underline">
									{tag.text}
								</a>
							))}
						</div>
					</div>
				</div>
			</div>
		);
	},
});
