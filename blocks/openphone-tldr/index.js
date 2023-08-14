import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { useBlockProps } from '@wordpress/block-editor';
import { RichText } from '@wordpress/block-editor';
import { useState } from '@wordpress/element';

const { name, ...settings } = metadata;

registerBlockType(name, {
	...settings,

	edit: (props) => {
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();

		const [isAccordionOpen, setIsAccordionOpen] = useState(false);

		const onChangeTitle = (title) => {
			setAttributes({ title });
		};

		const onChangeTitle2 = (title2) => {
			setAttributes({ title2 });
		};

		const onChangeContent = (content) => {
			setAttributes({ content });
		};

		const onChangeTldr = (tldrText) => {
			setAttributes({ tldrText });
		};

		const onAccordionToggle = () => {
			setIsAccordionOpen(!isAccordionOpen);
		};

		return (
			<div {...blockProps}>
				<div className="tldr-header-container">
					<RichText
						className="tldr-text"
						onChange={onChangeTldr}
						value={attributes.tldrText}
					/>
					<h2
						onClick={onAccordionToggle}
						style={{ cursor: 'pointer', margin: 0 }}
						className={isAccordionOpen ? 'active tldr-title' : 'tldr-title'}
					>
						<RichText
							tagName="span"
							onChange={onChangeTitle}
							value={attributes.title}
							style={{ margin: 0 }}
						/>
						<RichText
							tagName="span"
							className="title2"
							onChange={onChangeTitle2}
							value={attributes.title2}
						/>
					</h2>
				</div>
				{isAccordionOpen && (
					<div className="content">
						<RichText
							tagName="div"
							onChange={onChangeContent}
							value={attributes.content}
						/>
					</div>
				)}
			</div>
		);
	},

	save: ({ attributes }) => {
		return (
			<div className="tldr-block">
				<div className="tldr-header-container">
					<RichText.Content
						tagName="span"
						className="tldr-text"
						value={attributes.tldrText}
					/>
					<h2 className="tldr-title" style={{ margin: 0 }}>
						<RichText.Content tagName="span" value={attributes.title} />
						<span className="title2">
							<RichText.Content tagName="span" value={attributes.title2} />
						</span>
					</h2>
				</div>
				<div className={`content ${attributes.isOpen ? 'active' : ''}`}>
					<RichText.Content tagName="div" value={attributes.content} />
				</div>
			</div>
		);
	},	
});
