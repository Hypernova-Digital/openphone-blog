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

		const onChangeContent = (content) => {
			setAttributes({ content });
		};

		const onAccordionToggle = () => {
			setIsAccordionOpen(!isAccordionOpen);
		};

		return (
			<div {...blockProps}>
				<div className="tldr-header-container">
					<span className="tldr-text">TL;DR</span>
					<h2
						onClick={onAccordionToggle}
						style={{ cursor: 'pointer', margin: 0 }}
						className={isAccordionOpen ? 'active tldr-title' : 'tdlr-title'}
					>
						<RichText
							tagName="h2"
							onChange={onChangeTitle}
							value={attributes.title}
							style={{ margin: 0 }}
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
					<span className="tldr-text">TL;DR</span>
					<h2 className="tldr-title" style="margin: 0 !important;">
						<RichText.Content value={attributes.title} />
					</h2>
				</div>
				<div className={`content ${attributes.isOpen ? 'active' : ''}`}>
					<RichText.Content value={attributes.content} />
				</div>
			</div>
		);
	},
});
