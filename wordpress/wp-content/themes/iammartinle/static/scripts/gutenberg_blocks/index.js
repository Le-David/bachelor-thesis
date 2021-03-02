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

        return ([
            <div { ...blockProps}>
                <MediaUploadCheck>
                    <MediaUpload 
                        onSelect={ (media) => setAttributes({ media: media.sizes.full.url }) }
                        allowedTypes={ ALLOWED_MEDIA_TYPES }
                        value={ media }
                        render={ ( { open } ) => (
                            <IconButton
                                onClick={ open }
                                icon="upload"
                                className="editor-media-placeholder__button is-button is-default is-large"
                            >
                                Upload/edit image
                            </IconButton>
                        ) }
                    />
                </MediaUploadCheck>
                <RichText
                    tagName="h2"
                    value={ title }
                    placeholder="Add title..."
                    onChange={ (title) => setAttributes({ title }) }
                />
                <RichText
                    tagName="p"
                    value={ content }
                    placeholder="Add content..."
                    onChange={ (content) => setAttributes({ content }) }
                />
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
            <div { ...blockProps}>
                <img src={ media } />
                <h2>{ title }</h2>
                <RichText.Content
                    tagName="p"
                    value={ content }
                />
            </div>
        )
    },
})
