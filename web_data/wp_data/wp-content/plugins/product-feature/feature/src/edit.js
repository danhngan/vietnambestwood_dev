/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { PanelBody, TextControl, ToggleControl, __experimentalNumberControl as NumberControl } from '@wordpress/components';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(props) {
	const { attributes, className, setAttributes } = props;
	let { domain } = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__('Settings', 'block-product-feature-nop')}
				>
				</PanelBody>
			</InspectorControls>
			<div {...useBlockProps()}>
				<div id="showing-product-picture" class="main-image-div">
					Wood Shavings are the perfect choice for animal bedding; be it cattle, poultry, or smaller creatures.
					Our high-quality, dust-free, and well-dried Wood Shavings are well trusted by major farming corporations as well as equestrian farms and horse racing clubs.
					Types: Mixed Wood, Pinewood
				</div>
			</div>
		</>
	);
}