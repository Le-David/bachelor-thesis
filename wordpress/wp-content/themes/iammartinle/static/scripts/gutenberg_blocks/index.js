const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { IconButton } = wp.components
const {
    MediaUpload,
    MediaUploadCheck,
    RichText,
    useBlockProps
} = wp.blockEditor

const ALLOWED_MEDIA_TYPES = [ 'image' ];

registerBlockType('gutenberg-block/aside-media-content', {
    apiVersion: 2,
    title: 'Aside media content',
    description: 'Block to generate a custom aside media content',
    icon: 'align-left', // icon used in admin section
    category: 'layout', // under which category will be find
    keywords: [ __( 'media' ), __( 'image' ), __( 'photo' ), __( 'content' ), __( 'text' ) ], // another aliases when need to find certain block

    attributes: {
        title: {
            type: 'string',
            source: 'html',
            selector: 'h2'
        },
        content: {
            type: 'string',
            source: 'html',
            selector: 'p'
        },
        media: {
            type: 'string',
            default: 'https://via.placeholder.com/710',
        }
    },

    edit: (props) => { // edit function which handles editation part (the part in wordpress - for example add/change text, picture, etc.)

        const {
            attributes: {
                title,
                content,
                media,
            },
            setAttributes,
        } = props

        const blockProps = useBlockProps();

        function onSelectImage(newMedia){
            setAttributes({ media: newMedia.sizes.full.url })
        }

        return ([
            <div { ...blockProps} className={ `${blockProps.className} asideMediaContent` }>
                <MediaUploadCheck>
                    <MediaUpload 
                        onSelect={ onSelectImage }
                        allowedTypes={ ALLOWED_MEDIA_TYPES }
                        value={ media }
                        render={ ( { open } ) => {
                            return <div className="asideMediaContentEditor-mediaUpload asideMediaContent-media">
                                <img className="asideMediaContentEditor-mediaUpload-image" src={ media }/>
                                <IconButton
                                    onClick={ open }
                                    icon="upload"
                                    className="asideMediaContentEditor-mediaUpload-button editor-media-placeholder__button is-button is-default is-large"
                                >
                                    Upload/edit image
                                </IconButton>
                            </div>
                        } }
                    />
                </MediaUploadCheck>
                <div className="asideMediaContentEditor-content asideMediaContent-content">
                    <RichText
                        tagName="h2"
                        value={ title }
                        placeholder="Add title..."
                        onChange={ (title) => setAttributes({ title }) }
                        className="asideMediaContent-title"
                    />
                    <RichText
                        tagName="p"
                        value={ content }
                        placeholder="Add content..."
                        onChange={ (content) => setAttributes({ content }) }
                        className="asideMediaContent-text"
                    />
                </div>
            </div>
        ])
    },

    save: (props) => { // save function which handles saved part (the part which is rendered on frontend - website)

        const {
            attributes: {
                title, 
                content,
                media,
            },
        } = props

        const blockProps = useBlockProps.save();

        return (
            <div { ...blockProps} className={ `${blockProps.className} asideMediaContent` }>
                <div className="asideMediaContent-media">
                    <img className="asideMediaContent-image" src={ media } alt={ title }/>
                </div>
                <div className="asideMediaContent-content">
                    <RichText.Content
                        tagName="h2"
                        value={ title }
                        className="asideMediaContent-title"
                    />
                    <RichText.Content
                        tagName="p"
                        value={ content }
                        className="asideMediaContent-text"
                    />
                </div>
            </div>
        )
    },
})
