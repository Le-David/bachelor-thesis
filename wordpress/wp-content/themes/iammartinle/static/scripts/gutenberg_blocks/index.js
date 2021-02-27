const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { useBlockProps } = wp.blockEditor

registerBlockType('gutenberg-block/aside-media-content', {
    apiVersion: 2,
    title: 'Aside media content',
    description: 'Block to generate a custom aside media content',
    icon: 'align-left', // icon used in admin section
    category: 'layout', // under which category will be find
    keywords: [ __( 'media' ), __( 'image' ), __( 'photo' ), __( 'content' ), __( 'text' ) ], // another aliases when need to find certain block

    edit: (props) => { // edit function which handles editation part (the part in wordpress - for example add/change text, picture, etc.)
        const blockProps = useBlockProps();

        return <p { ...blockProps }>Hello world! (edit)</p>
    },

    save: (props) => { // save function which handles saved part (the part which is rendered on frontend - website)
        const blockProps = useBlockProps.save();

        return <p { ...blockProps }>Hello world! (save)</p>
    },
})
