import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import { SelectControl } from '@wordpress/components';
import metadata from './block.json';

const { name, ...settings } = metadata;

registerBlockType(name, {
    ...settings,

    edit: (props) => {
        const { attributes, setAttributes } = props;

        const categories = useSelect((select) => {
            return select('core').getEntityRecords('taxonomy', 'category');
        }, []);

        const posts = useSelect((select) => {
            return select('core').getEntityRecords('postType', 'post', {
                per_page: attributes.postsToShow,
                categories: attributes.selectedCategory
            });
        }, [attributes]);

        return (
            <div className={props.className}>
                <SelectControl
                    label="Category"
                    value={attributes.selectedCategory}
                    options={categories && categories.map((category) => ({
                        value: category.id,
                        label: category.name
                    }))}
                    onChange={(selectedCategory) => setAttributes({ selectedCategory })}
                />

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
