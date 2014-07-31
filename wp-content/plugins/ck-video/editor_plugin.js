// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('ckvideo');
	 
	tinymce.create('tinymce.plugins.ckvideo', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('ckvideo', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 680,
					height : 490,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('ckvideo', {
				title : 'ckvideo',
				cmd : 'ckvideo',
				image : url + '/images/ckvideo.png'
			});
			
			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('ckvideo', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'ckvideo',
					author 	  : 'Many drops of make an ocean',
					authorurl : 'http://www.qiuxinjiang.cn',
					infourl   : 'http://www.qiuxinjiang.cn',
					version   : "0.1 beta"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('ckvideo', tinymce.plugins.ckvideo);
})();


