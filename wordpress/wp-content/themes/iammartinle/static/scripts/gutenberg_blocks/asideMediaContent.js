const { __ } = wp.i18n
const { registerBlockType } = wp.blocks

registerBlockType('gutenberg-block/aside-media-content', {
    apiVersion: 2, // enabling blocks to render their own block wrapper element
    title: 'Aside media content',
    icon: 'align-left', // icon used in admin section
    category: 'layout', // under which category will be find
    keywords: [ __( 'media' ), __( 'image' ), __( 'photo' ), __( 'content' ), __( 'text' ) ], // another aliases when need to find certain block

    edit() {}, // edit function which handles editation part (the part in wordpress - for example add/change text, picture, etc.)

    save() {}, // save function which handles saved part (the part which is rendered on frontend - website)
})
