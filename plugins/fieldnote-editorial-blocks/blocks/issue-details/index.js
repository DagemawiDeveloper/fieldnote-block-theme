( function( blocks, blockEditor, components, element, i18n ) {
	'use strict';

	const el = element.createElement;
	const { InspectorControls, RichText, useBlockProps } = blockEditor;
	const { PanelBody, TextControl, TextareaControl } = components;
	const { __ } = i18n;

	blocks.registerBlockType( 'fieldnote/issue-details', {
		title: __( 'Issue Details', 'fieldnote-editorial-blocks' ),
		description: __(
			'Present structured context for a journal issue.',
			'fieldnote-editorial-blocks',
		),
		icon: 'book-alt',
		category: 'fieldnote-editorial',
		attributes: {
			eyebrow: { type: 'string', default: 'Field journal / 2026' },
			issueNumber: { type: 'string', default: '08' },
			title: { type: 'string', default: 'Notes from the edge' },
			summary: {
				type: 'string',
				default:
					'Patient technology, public spaces, and the quiet work behind lasting change.',
			},
			dateLabel: { type: 'string', default: 'August 2026' },
		},
		edit: function Edit( { attributes, setAttributes } ) {
			const blockProps = useBlockProps( {
				className: 'fieldnote-issue-details',
			} );

			return el(
				element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{
							title: __(
								'Issue settings',
								'fieldnote-editorial-blocks',
							),
							initialOpen: true,
						},
						el( TextControl, {
							label: __(
								'Issue number',
								'fieldnote-editorial-blocks',
							),
							value: attributes.issueNumber,
							onChange: ( issueNumber ) =>
								setAttributes( { issueNumber } ),
						} ),
						el( TextControl, {
							label: __(
								'Date label',
								'fieldnote-editorial-blocks',
							),
							value: attributes.dateLabel,
							onChange: ( dateLabel ) =>
								setAttributes( { dateLabel } ),
						} ),
						el( TextareaControl, {
							label: __(
								'Summary',
								'fieldnote-editorial-blocks',
							),
							value: attributes.summary,
							onChange: ( summary ) =>
								setAttributes( { summary } ),
						} ),
					),
				),
				el(
					'section',
					blockProps,
					el( RichText, {
						tagName: 'p',
						className: 'fieldnote-issue-details__eyebrow',
						value: attributes.eyebrow,
						allowedFormats: [],
						placeholder: __(
							'Issue label',
							'fieldnote-editorial-blocks',
						),
						onChange: ( eyebrow ) => setAttributes( { eyebrow } ),
					} ),
					el(
						'p',
						{
							className: 'fieldnote-issue-details__number',
							'aria-hidden': true,
						},
						attributes.issueNumber,
					),
					el( RichText, {
						tagName: 'h2',
						className: 'fieldnote-issue-details__title',
						value: attributes.title,
						allowedFormats: [ 'core/italic' ],
						placeholder: __(
							'Issue title',
							'fieldnote-editorial-blocks',
						),
						onChange: ( title ) => setAttributes( { title } ),
					} ),
					el(
						'p',
						{ className: 'fieldnote-issue-details__summary' },
						attributes.summary,
					),
					el(
						'p',
						{ className: 'fieldnote-issue-details__date' },
						attributes.dateLabel,
					),
				),
			);
		},
		save() {
			return null;
		},
	} );
}(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.element,
	window.wp.i18n,
) );
