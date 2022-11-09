<script>
import Vue from "vue";

let that = this;
import VuePNotify from 'vue-pnotify'

Vue.use(VuePNotify)

export default {

    mounted() {


        that = this


    },
    filters: {
        snakeToTitleCase: function (value) {
            if (!value) return ''
            //ref: https://gist.github.com/kkiernan/91298079d34f0f832054
            return value.split('_').map(function (item) {
                return item.charAt(0).toUpperCase() + item.substring(1);
            }).join(' ');
        }
    },
    methods: {
        $can(permissionName) {
            return Permissions.indexOf(permissionName) !== -1;
        },
        $hasRole(user_role, roles = []) {
            for (let i = 0; i < roles.length; i++) {
                if (user_role === roles[i]) return true;
            }
            return false;
        },
        line_break_with_paragraph(text) {
            var lines = text.split('\n');
            var break_content_text = '';
            for (var i = 0; i < lines.length; i++) {
                break_content_text += '<p>' + lines[i] + '</p>';
            }
            return break_content_text;
        },
        convert_paragraph_to_lines(text) {
            var break_content_text = text.replaceAll('<p>', '');
            return break_content_text.replaceAll('</p>', '\n');
        },
        notify: function (title, text, icon = 'fas fa-check', type = 'success', animate_type = 'lightSpeedIn') {
            this.$notify({
                title: title,
                text: text,
                icon: icon,
                style: type,
                delay: 1000,
                animate: {
                    animate: true,
                    animateSpeed: 3000,
                    in_class: animate_type,
                    out_class: 'lightSpeedOut',
                },
            })
        },
        confirm_delete: function (text, fn) {
            // Setup
            var notice = new PNotify({
                title: 'Confirmation',
                text: text,
                hide: false,
                type: 'warning',
                confirm: {
                    confirm: true,
                    buttons: [
                        {
                            text: 'Yes',
                            addClass: 'btn btn-sm btn-danger'
                        },
                        {
                            addClass: 'btn btn-sm btn-link'
                        }
                    ]
                },
                buttons: {
                    closer: true,
                    sticker: false
                }
            })

            // On confirm
            notice.get().on('pnotify.confirm', function () {
                // find object
                var fnc = that.$root.$children[0][fn];
                if (typeof fn === "function") fnc()
                that.$root.$children[0][fn]()

            })

            // On cancel
            notice.get().on('pnotify.cancel', function () {

            });


        },
        list_view() {
            this.view_type_class = 'col-md-12 view-2';
        },
        grid_view() {
            this.view_type_class = 'col-md-3';
        },
        showError(error) {
            console.log(error)
            let message_title = error.response.data.message + '\n';
            let message = message_title;
            let errors = error.response.data.errors;
            let title = error.response.data.title ? error.response.data.title : 'Title'
            let type = error.response.data.type ? error.response.data.type : 'danger'
            $.each(errors, function (key, val) {
                $.each(val, function (key2, val2) {
                    message += val2 + '\n'
                });
            });
            this.notify(title, message, 'fas fa-times p-1', type, 'jello')
        },
    }


};


function hasClass(el, className) {
    if (el.classList) return el.classList.contains(className);
    else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
}

function addClass(el, className) {
    if (el.classList) el.classList.add(className);
    else if (!hasClass(el, className)) el.className += " " + className;
}

function removeClass(el, className) {
    if (el.classList) el.classList.remove(className);
    else if (hasClass(el, className)) {
        var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
        el.className = el.className.replace(reg, ' ');
    }
}

</script>
