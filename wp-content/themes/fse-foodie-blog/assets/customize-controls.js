( function( api ) {

	// Extends our custom "fse-foodie-blog" section.
	api.sectionConstructor['fse-foodie-blog'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );