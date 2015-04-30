(function() {
    tinymce.create('tinymce.plugins.couponer', {
        init : function(ed, url) {	
			ed.addButton('couponergrid', {
				type: 'listbox',
				text: 'Couponer Grid',
				icon: false,
				onselect: function(e) {
					var value = this.value();
					if( value !== "" ){
						switch( value ){
							case 'row'		:ed.execCommand('mceInsertContent', 0, '[couponer_row][/couponer_row]'); break;
							case 'columns'  : 
								var col = prompt("Column ( 1 - 12 ): ");
								if (col !== "") {
									ed.execCommand('mceInsertContent', 0, '[couponer_col md="'+col+'"][/couponer_col]');
								}								
					
						}
					}
				},
				values: [
					{ text: 'Row', value: 'row' },
					{ text: 'Columns', value: 'columns' },
				],
				onPostRender: function() {
					ed.my_control = this;
				}
			});
			/* elements */
			ed.addButton('couponerelements', {
				type: 'listbox',
				text: 'Couponer Elements',
				icon: false,
				onselect: function(e) {
					var value = this.value();
					if( value !== "" ){
						switch( value ){
							case 'button' : ed.windowManager.open({
												title  : 'Add Button',
												file   : url + '/modals/button_dialog.php',
												width  : 900,
												height : 600,
												inline : 1
											});break;
						}
					}
				},
				values: [
					{ text: 'Button', value: 'button' },
				],
				onPostRender: function() {
					ed.my_control = this;
				}
			});			
        }
    });
    // Register plugin
    tinymce.PluginManager.add( 'couponer', tinymce.plugins.couponer );
})();