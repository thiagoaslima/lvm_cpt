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

    var LVM = window.LVM,
        LVM_people = Object.create(LVM);


    LVM_people.extend({
        name: "people",

        contatos: {

            init: function (argument) {
                var self = this;

                self.helpers.buildCampos();
            },

            helpers: {

                buildCampos: function (argument) {
                    var self = this,
                        campos = self.campos,
                        campo,
                        c;

                    for (campo in campos.lista) {
                        c = campos[campo] || {};

                        LVM.extend.call("c", {
                            tmplID: campo + "-tmp",

                            runObj: function () {
                                var obj = {},
                                    funcs = this.runObjConst,
                                    func;

                                for (func in funcs) {
                                    if (funcs.hasOwnProperty(func)) {
                                        obj[func] = funcs[func]();
                                    }
                                }
                            },

                            augmentRunObjConst: function() {
                                var objConst = this.runObjConst || {},
                                    classe = "." + campo,
                                    number = $(classe).find(".line").length;

                                objConst.number = number;
                            }
                        })
                    }
                }

            },

            template: "people.html",

            campos: {
                lista: ["email", "tel", " end"],
                listaExtenso: ["email", "telefone", "endereço"],
            }

        }
    });

    LVM.extend({people: LVM_people});

}(jQuery, window, document));

