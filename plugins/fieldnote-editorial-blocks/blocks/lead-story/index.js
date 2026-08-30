( function ( blocks, blockEditor, components, coreData, data, element, i18n, ServerSideRender ) {
	'use strict';

	const el = element.createElement;
	const { InspectorControls, useBlockProps } = blockEditor;
	const { PanelBody, SelectControl, TextControl, ToggleControl } = components;
	const { useSelect } = data;
	const { __ } = i18n;

	function plainTitle( renderedTitle ) {
		const temporary = document.createElement( 'textarea' );
		temporary.innerHTML = renderedTitle || '';
		return temporary.value.replace( /<[^>]+>/g, '' );
	}

	blocks.registerBlockType( 'fieldnote/lead-story', {
		title: __( 'Lead Story', 'fieldnote-editorial-blocks' ),
		description: __( 'Select a published post and present it as an editorial lead.', 'fieldnote-editorial-blocks' ),
		icon: 'cover-image',
		category: 'fieldnote-editorial',
		attributes: {
			postId: { type: 'integer', default: 0 },
			eyebrow: { type: 'string', default: 'Featured dispatch' },
			layout: { type: 'string', default: 'split' },
			imagePosition: { type: 'string', default: 'left' },
			showCategory: { type: 'boolean', default: true },
			showExcerpt: { type: 'boolean', default: true },
		},
		edit( { attributes, setAttributes } ) {
			const posts = useSelect(
				( select ) =>
					select( coreData.store ).getEntityRecords( 'postType', 'post', {
						per_page: 20,
						status: 'publish',
						order: 'desc',
						orderby: 'date',
						_fields: 'id,title',
					} ),
				[]
			);
			const options = [
				{ label: __( 'Latest published post', 'fieldnote-editorial-blocks' ), value: 0 },
				...( posts || [] ).map( ( post ) => ( {
					label: plainTitle( post.title.rendered ) || __( '(Untitled)', 'fieldnote-editorial-blocks' ),
					value: post.id,
				} ) ),
			];
			const blockProps = useBlockProps( { className: 'fieldnote-lead-story-editor' } );

			return el(
				element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{
							title: __( 'Story selection', 'fieldnote-editorial-blocks' ),
							initialOpen: true,
						},
						el( SelectControl, {
							label: __( 'Published post', 'fieldnote-editorial-blocks' ),
							value: attributes.postId,
							options,
							onChange: ( postId ) => setAttributes( { postId: Number.parseInt( postId, 10 ) || 0 } ),
						} ),
						el( TextControl, {
							label: __( 'Eyebrow', 'fieldnote-editorial-blocks' ),
							value: attributes.eyebrow,
							onChange: ( eyebrow ) => setAttributes( { eyebrow } ),
						} )
					),
					el(
						PanelBody,
						{
							title: __( 'Presentation', 'fieldnote-editorial-blocks' ),
							initialOpen: false,
						},
						el( SelectControl, {
							label: __( 'Layout', 'fieldnote-editorial-blocks' ),
							value: attributes.layout,
							options: [
								{ label: __( 'Split', 'fieldnote-editorial-blocks' ), value: 'split' },
								{ label: __( 'Stacked', 'fieldnote-editorial-blocks' ), value: 'stacked' },
							],
							onChange: ( layout ) => setAttributes( { layout } ),
						} ),
						attributes.layout === 'split' && el( SelectControl, {
							label: __( 'Image position', 'fieldnote-editorial-blocks' ),
							value: attributes.imagePosition,
							options: [
								{ label: __( 'Left', 'fieldnote-editorial-blocks' ), value: 'left' },
								{ label: __( 'Right', 'fieldnote-editorial-blocks' ), value: 'right' },
							],
							onChange: ( imagePosition ) => setAttributes( { imagePosition } ),
						} ),
						el( ToggleControl, {
							label: __( 'Show category', 'fieldnote-editorial-blocks' ),
							checked: attributes.showCategory,
							onChange: ( showCategory ) => setAttributes( { showCategory } ),
						} ),
						el( ToggleControl, {
							label: __( 'Show excerpt', 'fieldnote-editorial-blocks' ),
							checked: attributes.showExcerpt,
							onChange: ( showExcerpt ) => setAttributes( { showExcerpt } ),
						} )
					)
				),
				el(
					'div',
					blockProps,
					el( ServerSideRender, {
						block: 'fieldnote/lead-story',
						attributes,
						EmptyResponsePlaceholder: () => el( 'p', null, __( 'Publish a post to preview this block.', 'fieldnote-editorial-blocks' ) ),
					} )
				)
			);
		},
		save() {
			return null;
		},
	} );
} )(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.coreData,
	window.wp.data,
	window.wp.element,
	window.wp.i18n,
	window.wp.serverSideRender
);
