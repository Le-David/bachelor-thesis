const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { useBlockProps, RichText } = wp.blockEditor

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
        }
    },

    edit: (props) => { // edit function which handles editation part (the part in wordpress - for example add/change text, picture, etc.)

        const {
            attributes: {
                title, 
                content,
            },
            setAttributes,
        } = props

        const blockProps = useBlockProps();

        return ([
            <div { ...blockProps}>
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
                    multiline={ true }
                />
            </div>
        ])
    },

    save: (props) => { // save function which handles saved part (the part which is rendered on frontend - website)

        const {
            attributes: {
                title, 
                content
            },
        } = props

        const blockProps = useBlockProps.save();

        return (
            <div { ...blockProps}>
                <h2>{ title }</h2>
                <RichText.Content
                    tagName="div"
                    value={ content }
                />
            </div>
        )
    },
})
