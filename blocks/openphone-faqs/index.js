import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { useBlockProps } from '@wordpress/block-editor';


const { name, ...settings } = metadata;

registerBlockType(name, {
    ...settings,

    edit: (props) => {
        const { attributes, setAttributes } = props;
        const blockProps = useBlockProps();

        return (
           <div {...blockProps}>
            <h2>Hiiiii</h2>FAQ
           </div>
        );
    },

    save: ({ attributes }) => {
        return (
            <div>
                <h2>{attributes.textField}</h2>I'm a block!! FAQ FAQ
            </div>
        );
    },
});

 