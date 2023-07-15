import { useSelect } from '@wordpress/data';
import apiFetch from '@wordpress/api-fetch';
import { useState, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Placeholder, Spinner, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes, context } ) {
	const { selectedPost } = attributes;

	const [ posts, setPosts ] = useState( [] );
	const [ isLoading, setLoading ] = useState( true );

	useEffect( () => {
		apiFetch( { path: '/wp/v2/posts' } )
			.then( ( data ) => {
				setPosts( data );
				setLoading( false );
			} )
			.catch( () => {
				setLoading( false );
			} );
	}, [] );

	if ( isLoading ) {
		return (
			<Placeholder>
				<Spinner />
			</Placeholder>
		);
	}

	const options = posts.map( ( post ) => ( {
		label: post.title.rendered,
		value: post.id,
	} ) );

	const onChangeSelectPost = ( selectedPostId ) => {
		console.log('Selected post ID:', selectedPostId);
		const post = posts.find( ( { id } ) => id == selectedPostId );
		console.log('Found post:', post);
		if ( post ) {
			setAttributes( {
				selectedPost: post,
				title: post.title.rendered,
				date: new Date( post.date ).toLocaleDateString(),
				featuredImage: post.featured_image_src,
				primaryCategory: post.categories[0].name,
				postLink: post.link
			} );
		}
	};




	return (
		<SelectControl
			label={ __( 'Select a post', 'openphone' ) }
			value={ selectedPost.id }
			options={ options }
			onChange={ onChangeSelectPost }
		/>
	);
}
