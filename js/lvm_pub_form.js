(function ($, W, Doc, LVM) {

    "use strict";

        // Configuration and ES5 functions
    var shim = (function () {

            if (typeof Object.create !== 'function') {
                Object.create = function (o) {
                    function F() {}
                    F.prototype = o;
                    return new F();
                };
            }
        }()),

        LVM = LVM || {},
        
        LVM.fn = LVM.prototype,
        LVM.fn.constructor = LVM,

        // Helpers functions
        LVM.fn.helpers = LVM.fn.helpers || {},

        LVM.helpers.extendObj = 
        LVM.fn.helpers.extendObj = function ()

             = function

        // Property and Methods for Publications
        LVM.pubs = LVM.pubs || {},

        LVM.pubs = {

            config: {
                
                pluginUrl: (function(){
                    var url;

                    if(window.lvm.pubs.pluginUrl) {
                        url = window.lvm.pubs.pluginUrl;
                        delete window.lvm.pubs.pluginUrl;
                    } else {
                        url = "/wp-content/plugins/lvm_cpt" 
                    }

                    return url;
                })
            }
        }



}(jQuery, window, document, LVM ))