/*!
 * LVM JavaScript Library v0.0.1
 *
 * Depende de jQuery
 * versão de jQuery na época da criação: 1.8.3
 *
 * 24 Nov 2012 (Horário de Brasília)
 */

(function ($, W, D) {

    "use strict";

    // referencia geral do objeto
    var LVM = {};

    LVM.fn = LVM.prototype = {
        constructor: LVM,

        name: "LVM",

        config: {
            version: "0.0.1",
            pluginURL: (function () {
                var url;

                if (window.lvm.pubs.pluginUrl) {
                    url = window.lvm.pubs.pluginUrl;
                    delete window.lvm.pubs.pluginUrl;
                } else {
                    url = "/wp-content/plugins/lvm_cpt";
                }

                return url;
            }())
        },

        extend: function (methods) {
            var self = this,
                len,
                prop;

            if ($.isArray(methods)) {
                len = methods.length;
                while (len) {
                    len -= 1;
                    self.extend(methods[len]);
                }
            }

            for (prop in methods) {
                if (methods.hasOwnProperty(prop) &&
                        !self.hasOwnProperty(prop)) {
                    this[prop] = methods[prop];
                }
            }
        },

        handlers: {},

        templates: {}

    };

}(jQuery, window, document));