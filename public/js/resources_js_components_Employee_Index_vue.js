"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_Employee_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Employee/Index.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Employee/Index.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      items: [],
      event_types: [{
        id: 'live-webinars',
        name: 'Live webinars'
      }, {
        id: 'cad',
        name: 'CAD recording techniques'
      }, {
        id: 'workshop',
        name: 'On site workshop'
      }],
      event_type_id: '',
      search_value: ''
    };
  },
  mounted: function mounted() {
    this.get_events();
  },
  components: {},
  methods: {
    get_event_types: function get_event_types() {
      var _this = this;
      axios.get('/api/departments').then(function (response) {
        _this.loader = false;
        _this.departments = response.data.data;
      })["catch"](function (error) {});
    },
    get_events: function get_events() {
      var _this2 = this;
      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      axios.get('/vue/admin/event?q=' + this.search_value + '&event_type_id=' + this.event_type_id + '&page=' + page).then(function (response) {
        _this2.items = response.data.data;
      });
    },
    get_search_result: function get_search_result() {
      var _this3 = this;
      axios.get('/vue/admin/event?q=' + this.search_value + '&event_type_id=' + this.event_type_id).then(function (response) {
        _this3.items = response.data.data;
      });
    },
    delete_team: function delete_team(id, name) {
      var _this4 = this;
      this.$confirm({
        title: 'Confirm',
        message: 'Do you sure to delete "' + name + '" ?',
        button: {
          no: 'No',
          yes: 'Yes'
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: function callback(confirm) {
          if (confirm) {
            axios["delete"]('/vue/admin/event/' + id).then(function (response) {
              _this4.notify('success', 'Event deleted successfully', 'fas fa-check p-1');
              _this4.get_search_result();
            })["catch"](function (error) {
              _this4.showError(error);
            });
          }
        }
      });
    },
    showError: function showError(error) {
      var message_title = error.response.data.message + '\n';
      var message = message_title;
      var errors = error.response.data.errors;
      $.each(errors, function (key, val) {
        $.each(val, function (key2, val2) {
          message += val2 + '\n';
        });
      });
      this.notify("error", message, 'fas fa-times p-1', 'danger');
    }
  }
});

/***/ }),

/***/ "./resources/js/components/Employee/Index.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/Employee/Index.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_3819a4bc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=3819a4bc& */ "./resources/js/components/Employee/Index.vue?vue&type=template&id=3819a4bc&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/components/Employee/Index.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_3819a4bc___WEBPACK_IMPORTED_MODULE_0__.render,
  _Index_vue_vue_type_template_id_3819a4bc___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Employee/Index.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Employee/Index.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/Employee/Index.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Employee/Index.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Employee/Index.vue?vue&type=template&id=3819a4bc&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/Employee/Index.vue?vue&type=template&id=3819a4bc& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_3819a4bc___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_3819a4bc___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_3819a4bc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=template&id=3819a4bc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Employee/Index.vue?vue&type=template&id=3819a4bc&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Employee/Index.vue?vue&type=template&id=3819a4bc&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Employee/Index.vue?vue&type=template&id=3819a4bc& ***!
  \**************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("div", { staticClass: "page-header page-header-light" }, [
        _vm._m(0),
        _vm._v(" "),
        _c(
          "div",
          {
            staticClass:
              "breadcrumb-line breadcrumb-line-light header-elements-md-inline",
          },
          [
            _c("div", { staticClass: "d-flex" }, [
              _c(
                "div",
                { staticClass: "breadcrumb" },
                [
                  _c(
                    "router-link",
                    {
                      staticClass: "breadcrumb-item",
                      attrs: { to: { path: "/admin" } },
                    },
                    [
                      _c("i", { staticClass: "icon-home2 mr-2" }),
                      _vm._v(" Home\n                    "),
                    ]
                  ),
                  _vm._v(" "),
                  _c("span", { staticClass: "breadcrumb-item active" }, [
                    _vm._v("Events"),
                  ]),
                ],
                1
              ),
              _vm._v(" "),
              _vm._m(1),
            ]),
            _vm._v(" "),
            _vm._m(2),
          ]
        ),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "content" }, [
        _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header" }, [
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-9" }, [
                _c("form", { staticClass: "form-inline" }, [
                  _c(
                    "label",
                    {
                      staticClass: "sr-only",
                      attrs: { for: "inlineFormInputGroupUsername2" },
                    },
                    [_vm._v("Enter a word")]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "input-group mb-2" }, [
                    _vm._m(3),
                    _vm._v(" "),
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.search_value,
                          expression: "search_value",
                        },
                      ],
                      staticClass: "form-control",
                      staticStyle: { "border-radius": "0" },
                      attrs: {
                        type: "text",
                        id: "inlineFormInputGroupUsername2",
                        placeholder: "Search by event name",
                      },
                      domProps: { value: _vm.search_value },
                      on: {
                        input: function ($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.search_value = $event.target.value
                        },
                      },
                    }),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "input-group mb-2 mx-1" }, [
                    _vm._m(4),
                    _vm._v(" "),
                    _c(
                      "select",
                      {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.event_type_id,
                            expression: "event_type_id",
                          },
                        ],
                        staticClass: "form-control",
                        attrs: { name: "", id: "" },
                        on: {
                          change: function ($event) {
                            var $$selectedVal = Array.prototype.filter
                              .call($event.target.options, function (o) {
                                return o.selected
                              })
                              .map(function (o) {
                                var val = "_value" in o ? o._value : o.value
                                return val
                              })
                            _vm.event_type_id = $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          },
                        },
                      },
                      [
                        _c("option", { attrs: { value: "", selected: "" } }, [
                          _vm._v("Select"),
                        ]),
                        _vm._v(" "),
                        _vm._l(_vm.event_types, function (item) {
                          return _c(
                            "option",
                            { domProps: { value: item.id } },
                            [_vm._v(_vm._s(item.name))]
                          )
                        }),
                      ],
                      2
                    ),
                  ]),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-secondary mb-2 mr-1 ml-1",
                      attrs: { type: "submit" },
                      on: {
                        click: function ($event) {
                          $event.preventDefault()
                          return _vm.get_events.apply(null, arguments)
                        },
                      },
                    },
                    [
                      _vm._v(
                        "\n                                Search\n                            "
                      ),
                    ]
                  ),
                ]),
              ]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "col-md-3 text-right" },
                [
                  _c(
                    "router-link",
                    {
                      staticClass: "btn btn-primary",
                      attrs: { to: { path: "/admin/event/add" } },
                    },
                    [_vm._v("Add Event\n                        ")]
                  ),
                ],
                1
              ),
            ]),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-body" }, [
            _c("div", { staticClass: "table-responsive" }, [
              _c("table", { staticClass: "table" }, [
                _vm._m(5),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.items, function (item, index) {
                    return _c("tr", [
                      _c("th", [
                        item.department
                          ? _c("span", [_vm._v(_vm._s(item.department.name))])
                          : _c("span", [_vm._v("--")]),
                      ]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(item.position))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(item.name))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(item.transfer_no))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(item.email))]),
                      _vm._v(" "),
                      _c("td", [_vm._v(_vm._s(item.phone))]),
                      _vm._v(" "),
                      _c(
                        "td",
                        { staticStyle: { padding: "0" } },
                        [
                          _c(
                            "router-link",
                            {
                              staticClass: "btn btn-success ml-1 mr-1",
                              staticStyle: { padding: "4px" },
                              attrs: {
                                to: {
                                  path: "/admin/employees/edit/" + item.id,
                                },
                              },
                            },
                            [
                              _c("i", {
                                staticClass: "icon-pencil7",
                                staticStyle: { color: "white" },
                              }),
                              _vm._v(
                                "\n                                    Edit\n                                "
                              ),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "a",
                            {
                              staticClass: "btn btn-danger",
                              staticStyle: { padding: "4px" },
                              attrs: { href: "javascript:void(0)" },
                              on: {
                                click: function ($event) {
                                  return _vm.delete_team(item.id, item.name)
                                },
                              },
                            },
                            [
                              _c("i", {
                                staticClass: "icon-cross3",
                                staticStyle: {
                                  "font-weight": "bold",
                                  color: "white",
                                },
                              }),
                              _vm._v(
                                "\n                                    Delete\n                                "
                              ),
                            ]
                          ),
                        ],
                        1
                      ),
                    ])
                  }),
                  0
                ),
              ]),
            ]),
          ]),
        ]),
      ]),
      _vm._v(" "),
      _c("vue-confirm-dialog"),
    ],
    1
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "page-header-content header-elements-md-inline" },
      [
        _c("div", { staticClass: "page-title d-flex" }, [
          _c("h4", [
            _c("span", { staticClass: "font-weight-semibold" }, [
              _vm._v("Events"),
            ]),
          ]),
          _vm._v(" "),
          _c(
            "a",
            {
              staticClass: "header-elements-toggle text-default d-md-none",
              attrs: { href: "#" },
            },
            [_c("i", { staticClass: "icon-more" })]
          ),
        ]),
      ]
    )
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "a",
      {
        staticClass: "header-elements-toggle text-default d-md-none",
        attrs: { href: "#" },
      },
      [_c("i", { staticClass: "icon-more" })]
    )
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "header-elements d-none" }, [
      _c("div", { staticClass: "breadcrumb justify-content-center" }),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "input-group-prepend" }, [
      _c("div", { staticClass: "input-group-text" }, [
        _vm._v("Search by event name"),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "input-group-prepend" }, [
      _c("div", { staticClass: "input-group-text" }, [_vm._v("Event type")]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Name")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Date")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Link")]),
        _vm._v(" "),
        _c("th", { staticStyle: { width: "140px" } }, [_vm._v("Control")]),
      ]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);