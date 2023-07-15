import { RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { title, date, featuredImage, primaryCategory, postLink } = attributes;

	// Check if the attributes are defined
	if (title && date && featuredImage && primaryCategory && postLink) {
		return (
			<a className="featured-post" href={ postLink }>
				<div className="primary-category">
					<RichText.Content value={ primaryCategory } />
				</div>
				<h2 className="post-title">
					<RichText.Content value={ title } />
				</h2>
				<div className="post-date">
					<RichText.Content value={ date } />
				</div>
				<div className="featured-image" dangerouslySetInnerHTML={ { __html: featuredImage } } />
			</a>
		);
	} else {
		// If the attributes are not defined, render nothing.
		return null;
	}
}
