(function() {
    tinymce.create('tinymce.plugins.w_video', {
        init : function(ed, url) {
            ed.addButton('swf', {
                title : 'W video',
                image : url+'/v.png',
                onclick : function() {
                     //ed.selection.setContent('[swf]' + ed.selection.getContent() + '[/swf]');
                     ed.windowManager.open({
						file : url + '/window.php',
						width : 680,
						height : 490,
						inline : 1
					}, {
						plugin_url : url // Plugin absolute URL
					});
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('swf', tinymce.plugins.w_video);
})();