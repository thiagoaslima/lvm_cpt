/*!
 * LVM JavaScript v0.0.1
 *
 * Depende da biblioteca jQuery
 * versão do jQuery na época da criação: 1.8.3
 *
 * 25 Nov 2012 19:43 (Horário de Brasília)
 */

(function ($, window, doc) {

    // ES5 syntax
    "use strict";

    if (typeof Object.create !== 'function') {
        Object.create = function (o) {
            function F() {}
            F.prototype = o;
            return new F();
        };
    }

    // Objeto LVM
    var LVM = function () {

        // constantes e propriedades privadas
        var VERSION = "0.0.1",
            PLUGIN_URL = (function () {
                var url;

                if (window.lvm &&
                        window.lvm.pluginUrl) {
                    url = window.lvm.pluginUrl;
                    delete window.lvm.pluginUrl;
                } else {
                    url = "/wp-content/plugins/lvm_cpt";
                }

                return url;
            }());

        // métodos públicos
        return {
            name: "LVM",

            getPluginUrl: function () {
                return PLUGIN_URL;
            },

            getVersion: function () {
                return VERSION;
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
                        self[prop] = methods[prop];
                        console.log(prop, self, self[prop]);
                    }
                }

                return self;
            },

            handlers: {},

            templates: function (obj) {
                /*
                 * recebe o seguinte argumento
                 * obj.get ->  arquivo do template;
                 *             id do template (caso haja).
                 *             o nome do arquivo e a ID 
                 *             devem ser separados por um espaço.
                 *             ex.: arquivo.html #template
                 *             
                 * obj.run ->  objeto contendo os dados a serem
                 *             incluídos no template.
                 *             a prop do objeto deve seguir a mesma
                 *             nomenclatura do template (ambas em minusculas).
                 *             ex.: obj.run.nome => <p>{{nome}}</p>
                 *             
                 * obj.addTo-> jQuery DOM object que vai reeber o template.
                 *             ex.: $(".contatiner")
                 */
                var self = this,
                    pluginUrl = self.getPluginUrl(),
                    tmplRun = obj.run,
                    elem = obj.addTo,
                    spacePos,
                    file,
                    tmpID,
                    template,
                    str,

                    get = function () {
                        var url = pluginUrl + "/tmp/" + file;
                        return $.ajax({
                            url: url,
                            dataType: "html"
                        });
                    },

                    run = function (data) {
                        var $tempDiv = $("<div></div>").append(data),
                            template = $tempDiv.find(tmpID).html(),
                            prop,
                            regexp;

                        for (prop in tmplRun) {
                            if (tmplRun.hasOwnProperty(prop)) {
                                regexp = new RegExp("{{" + prop + "}}", "g");
                                template = template.replace(regexp,
                                    tmplRun[prop]);
                            }
                        }

                        return template;
                    },

                    addTo = function (elem) {
                        console.log(template);
                        elem.append(template);
                    };

                if (typeof obj.get === "string") {
                    str = obj.get;
                    spacePos = str.indexOf(" ");
                    file = str.substring(0, spacePos);
                    tmpID = str.substring(spacePos + 1);
                    tmpID = (tmpID.indexOf("#") === 0) ? tmpID : "#" + tmpID;
                }

                $.when(
                    get()
                ).done(function (data) {
                    template = run(data);
                    addTo(elem);
                });

                return self;
            }
        };
    };

    // expõe o objeto
    window.LVM = LVM();

}(jQuery, window, document));