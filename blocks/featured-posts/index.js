import { useState, useEffect } from '@wordpress/element';
import { select } from '@wordpress/data';
import { registerBlockType } from '@wordpress/blocks';
import { Modal, Button } from '@wordpress/components';

const PostSelectorBlock = () => {
	const [isModalOpen, setModalOpen] = useState(false);
	const [searchTerm, setSearchTerm] = useState('');
	const [currentPage, setCurrentPage] = useState(1);
	const [selectedPostId, setSelectedPostId] = useState('');
	const [pagesPosts, setPagesPosts] = useState([]);

	const handleOpenModal = () => {
		setModalOpen(true);
	};

	const handleCloseModal = () => {
		setModalOpen(false);
	};

	const handlePostSelection = (postId) => {
		setSelectedPostId(postId);
		handleCloseModal();
	};

	const handleSearchChange = (event) => {
		setSearchTerm(event.target.value);
		setCurrentPage(1); // Reset current page when search term changes
	};

	const handlePageChange = (pageNumber) => {
		setCurrentPage(pageNumber);
	};

	const getPosts = async () => {
		const response = await select('core').getEntityRecords('postType', 'post', {
			status: 'publish',
			per_page: 10,
			page: currentPage,
			search: searchTerm,
		});
		setPagesPosts(response || []);
	};

	useEffect(() => {
		getPosts();
	}, [searchTerm, currentPage]);

	return (
		<div>
			<Button isDefault onClick={handleOpenModal}>
				Select a Post
			</Button>

			{selectedPostId && (
				<div>
					<h3>Selected Post</h3>
					<p>ID: {selectedPostId}</p>
					{/* Fetch and display data based on the selectedPostId */}
				</div>
			)}

			{isModalOpen && (
				<Modal title="Select a Post" onRequestClose={handleCloseModal}>
					<input
						type="text"
						value={searchTerm}
						onChange={handleSearchChange}
						placeholder="Search posts..."
					/>
					{pagesPosts.length > 0 ? (
						<>
							<select
								value={selectedPostId}
								onChange={(event) => handlePostSelection(event.target.value)}
							>
								<option value="">Select a post</option>
								{pagesPosts.map((post) => (
									<option key={post.id} value={post.id}>
										{post.title.rendered}
									</option>
								))}
							</select>
							<div>
								<button
									disabled={currentPage === 1}
									onClick={() => handlePageChange(currentPage - 1)}
								>
									Previous Page
								</button>
								<button
									disabled={pagesPosts.length < 10}
									onClick={() => handlePageChange(currentPage + 1)}
								>
									Next Page
								</button>
							</div>
						</>
					) : (
						<p>No posts found.</p>
					)}
				</Modal>
			)}
		</div>
	);
};

registerBlockType('your-namespace/post-selector-block', {
	title: 'Post Selector Block',
	category: 'widgets',
	edit: PostSelectorBlock,
	save: () => null,
});
