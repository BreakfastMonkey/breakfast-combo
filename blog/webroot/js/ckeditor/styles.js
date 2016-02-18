CKEDITOR.stylesSet.add( 'default', [
	
	/* Block Styles */
	
	{
		name: 'Paragraph',
		element: 'p',
	},
	
	{
		name: 'Heading 2',
		element: 'h2',
	},
	
	{
		name: 'Heading 3',
		element: 'h3',
	},
	
	{
		name: 'Heading 4',
		element: 'h4',
	},
	
	{
		name: 'Heading 4',
		element: 'h5',
	},
	
	{
		name: 'Heading 4',
		element: 'h6',
	},
	
	
	/* Inline Styles */
	
	{
		name: 'Small',
		element: 'small',
	},
	
	{
		name: 'Big',
		element: 'big',
	},
	
	/* Object Styles */
	
	{
		name: 'Compact table',
		element: 'table',
		attributes: {
			cellpadding: '5',
			cellspacing: '0',
			border: '1',
			bordercolor: '#ccc'
		},
		styles: {
			'border-collapse': 'collapse'
		}
	},

	{ 
		name: 'Borderless Table',		
		element: 'table',	
		styles: { 
			'border-style': 'hidden', 
			'background-color': '#E6E6FA' 
		} 
	},
	
	{ 
		name: 'Square Bulleted List',	
		element: 'ul',		
		styles: { 
			'list-style-type': 'square' 
		} 
	}
	
] );