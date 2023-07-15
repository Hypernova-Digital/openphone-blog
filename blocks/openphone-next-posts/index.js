import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

const { name, ...settings } = metadata;

registerBlockType(name, {
    ...settings,

    edit: (props) => {
        const { attributes } = props;

        const posts = useSelect((select) => {
            return select('core').getEntityRecords('postType', 'post', {
                per_page: attributes.postsToShow,
                offset: 1
            });
        }, [attributes.postsToShow]);

        return (
            <div className={props.className}>
                {posts && posts.map((post) => (
                    <div key={post.id}>
                        <h2>{post.title.rendered}</h2>
                        <div dangerouslySetInnerHTML={{ __html: post.excerpt.rendered }} />
                    </div>
                ))}
            </div>
        );
    },

    save: () => null,
});

