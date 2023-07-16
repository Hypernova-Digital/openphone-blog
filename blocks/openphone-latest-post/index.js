import { registerBlockType } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from './block.json'; // Import the block metadata.

const edit = (props) => {
	const { attributes, setAttributes, isSelected } = props;

	const latestPost = useSelect((select) => {
		const posts = select('core').getEntityRecords('postType', 'post', {
			per_page: 1,
		});
		return posts && posts.length ? posts[0] : null;
	}, []);

	const blockProps = useBlockProps();

	return (
		<div className={props.className} {...blockProps}>
			{latestPost ? (
				<>
					<div className="latest-post flex flex-row items-center">
						<div className="content">
							<h2>{latestPost.title.rendered}</h2>
							<div
								dangerouslySetInnerHTML={{
									__html: latestPost.excerpt.rendered,
								}}
							/>
						</div>
						<div className="image">
							<img
								src={latestPost.featured_image_src}
								alt={latestPost.title.rendered}
							/>
						</div>
					</div>
				</>
			) : (
				'Loading...'
			)}
		</div>
	);
};

// This is the save function for the block.
const save = () => null;

// Extract the block metadata.
const { name, category, icon, title } = metadata;

// Register the block.
registerBlockType(name, { title, category, icon, edit, save });
