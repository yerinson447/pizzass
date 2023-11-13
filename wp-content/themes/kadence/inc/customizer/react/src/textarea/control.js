import TextareaComponent from './textarea-component.js';

export const TextareaControl = wp.customize.KadenceControl.extend( {
	renderContent: function renderContent() {
		let control = this;
	ReactDOM.render( <TextareaComponent control={ control } />, control.container[0] );
	}
} );
