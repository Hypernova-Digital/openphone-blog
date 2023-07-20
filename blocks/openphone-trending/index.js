import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { useBlockProps, RichText, MediaUpload, URLInput, InnerBlocks } from '@wordpress/block-editor';
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

        const onChangeTag = (index, tag) => {
            const newTags = [...tags];
            newTags[index] = tag;
            setAttributes({ tags: newTags });
        };

        const addTag = () => {
            const newTags = [...tags, ''];
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
                            onSelect={(media) => onChangeCard(index, 'img', media.url)}
                            type="image"
                            value={card.img}
                            render={({ open }) => <Button onClick={open}>Upload Image</Button>}
                        />
                        <RichText
                            tagName="h4"
                            onChange={(text) => onChangeCard(index, 'text', text)}
                            value={card.text}
                        />
                        <URLInput
                            value={card.link}
                            onChange={(link) => onChangeCard(index, 'link', link)}
                        />
                    </Fragment>
                ))}
                <Button onClick={addCard}>Add Card</Button>
                {tags.map((tag, index) => (
                    <TextControl
                        key={index}
                        label="Tag"
                        value={tag}
                        onChange={(tag) => onChangeTag(index, tag)}
                    />
                ))}
                <Button onClick={addTag}>Add Tag</Button>
            </div>
        );
    },

    save: ({ attributes }) => {
        const { title, cards, tags } = attributes;

        return (
            <div>
                <h2>{title}</h2>
                {cards.map((card, index) => (
                    <div key={index}>
                        <img src={card.img} alt={card.text} />
                        <h4>{card.text}</h4>
                        <a href={card.link}>Read More</a>
                    </div>
                ))}
                <div>
                    {tags.map((tag, index) => (
                        <span key={index}>{tag}</span>
                    ))}
                </div>
            </div>
        );
    },
});
