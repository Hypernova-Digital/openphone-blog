import { useSelect } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import { SelectControl, TextControl, ToggleControl } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck, URLInput } from '@wordpress/block-editor';
import metadata from './block.json';
import { RichText } from '@wordpress/block-editor';

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
            <>
            <RichText
                tagName="h4"
                value={attributes.preHeader}
                placeholder='Pre Header(optional)'
                onChange={(preHeader) => setAttributes({ preHeader })}
            />
            
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

                <ToggleControl
                    label="Show Browse Resources"
                    checked={attributes.showBrowseResources}
                    onChange={(showBrowseResources) => setAttributes({ showBrowseResources })}
                />

                {attributes.showBrowseResources && (
                    <>
                        <label>Browse Resources Link</label>
                        <URLInput
                            value={attributes.browseResourcesLink}
                            onChange={(browseResourcesLink) => setAttributes({ browseResourcesLink })}
                        />

                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(media) => setAttributes({ browseResourcesImage: media.url })}
                                allowedTypes={['image']}
                                value={attributes.browseResourcesImage}
                                render={({ open }) => (
                                    <button onClick={open}>
                                        Upload Image
                                    </button>
                                )}
                            />
                        </MediaUploadCheck>

                        <RichText
                            tagName="p"
                            value={attributes.browseResourcesText}
                            placeholder='Browse Resources Text'
                            onChange={(browseResourcesText) => setAttributes({ browseResourcesText })}
                        />
                    </>
                )}
            </div>
            </>
        );
    },

    save: () => null,
});
