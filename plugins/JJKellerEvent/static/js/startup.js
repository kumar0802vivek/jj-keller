pimcore.registerNS("pimcore.plugin.jjkellerevent");

pimcore.plugin.jjkellerevent = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.jjkellerevent";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },
 
    pimcoreReady: function (params,broker){
        // alert("JJKellerEvent Plugin Ready!");
    },
    postSaveObject: function(object){
                   
        if (object.data.general.o_classId == 10) {
            // o_classId == 10 for HtmlBlock 
            var elementId = object.id;
            var cmp = $('#object_toolbar_' + elementId + '-targetEl').find('span.pimcore_icon_reload');
            cmp.trigger("click");
        }
    }
});

var jjkellereventPlugin = new pimcore.plugin.jjkellerevent();

