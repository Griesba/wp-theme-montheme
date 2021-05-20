const {registerBlockType} = wp.blocks
const {RichText, InspectorControls, MediaUpload} = wp.editor
const {ColorPicker} = wp.components

registerBlockType('montheme/hero', {
	title: 'Hero',
	category: 'widgets',
	supports: {
		html: false
	},
	edit ({className, attributes, setAttributes}) {
		const style = {
			color: attributes.color,
			backgroundImage: `url(${attributes.mediaURL})`
		}
		return <div className={className} style={style}>
			<div className="container">
				<h2><RichText
					tagName="div"
					placeholder="Votre contenu"
					value={attributes.title}
					onChange={title => setAttributes({title})}
				/></h2>
				<RichText
					tagName="div"
					placeholder="Votre contenu"
					value={attributes.content}
					onChange={content => setAttributes({content})}
				/>
			</div>
			<InspectorControls>
				<h2>Choisissez la couleur de texte</h2>
				<ColorPicker
					color={ attributes.color }
					onChangeComplete={ color => setAttributes({color: color.hex}) }
					disableAlpha
				/>
				<h2>Image de fond</h2>
				<MediaUpload
					type="image"
					onSelect={image => setAttributes({mediaID: image.id, mediaURL: image.sizes.full.url})}
					render={({open}) => (
						<button onClick={open}>Choisir une image</button>
					)}
				/>
			</InspectorControls>
		</div>
	},
	save () {
		return null;
	}
})
