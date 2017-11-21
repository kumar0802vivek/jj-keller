pimcore.registerNS("pimcore.plugin.jjkeller");

pimcore.plugin.jjkeller = Class.create(pimcore.plugin.admin, {
    getClassName: function () {
        return "pimcore.plugin.jjkeller";
    },
//    initialize: function () {
//        pimcore.plugin.broker.registerPlugin(this);
//    },
    
    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);

        this.navEl = Ext.get('pimcore_menu_search').insertSibling('<li id="pimcore_menu_mds" data-menu-tooltip="JJ-Keller Product Import" class="pimcore_menu_item pimcore_menu_needs_children">JJ-Keller Product Import</li>', 'after');
        this.menu = new Ext.menu.Menu({
            cls: "pimcore_navigation_flyout"
        });
        pimcore.layout.toolbar.prototype.mdsMenu = this.menu;
    },
    
    pimcoreReady: function(params, broker) {
        var toolbar = pimcore.globalmanager.get("layout_toolbar");
        this.navEl.on("mousedown", this.showPromoteExceptionsTab);
        pimcore.plugin.broker.fireEvent("mdsMenuReady", toolbar.mdsMenu);
    },


    showPromoteExceptionsTab: function () {
        Ext.MessageBox.show({
            title: 'Bulk Product Import',
            msg: 'Please click OK button to start bulk product import',
            buttons: Ext.MessageBox.OKCANCEL,
            icon: Ext.MessageBox.INFO,
            minWidth: 300,
            fn: function (btn) {
                if (btn == 'ok') {
                    //var loadMask = new Ext.LoadMask(Ext.getBody(), {msg:"Loading"});

                    // Screen masking during import in progress
                    loadText = 'Importing bulk products. Please wait...';
                    Ext.getBody().mask(loadText, 'loading')
                    Ext.Ajax.request({
                        url: '/plugin/Jjkeller/index/start-product-import',
                        async: false,
                        method: 'POST',
                        success: function (data) {
                            // Hide screen masking during import in progress
                            Ext.getBody().unmask(); 
                            Ext.Msg.alert("Bulk Product Import","Product import process completed.");
                        },
                        failure: function (conn, response, options, eOpts) {
                             // Hide screen masking during import in progress
                            Ext.getBody().unmask(); 
                            Ext.Msg.alert("Bulk Product Import","Product import process failed.");
                        }
                    });
                }

            }
        });
        
    }
});
var jjkellerPlugin = new pimcore.plugin.jjkeller();

