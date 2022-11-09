<template>
    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">المستخدمين</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <router-link class="breadcrumb-item"  :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> الرئيسية
                        </router-link>
                        <span class="breadcrumb-item active">المستخدمين</span>
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">


                    </div>
                </div>
            </div>
        </div>
        <!-- /page header -->
        <div class="content">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-9">
                            <form class="form-inline">

                                <label class="sr-only" for="inlineFormInputGroupUsername2">ادخل كلمة البحث</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">بحث</div>
                                    </div>
                                    <input type="text" style="border-radius: 0" v-model="search_value"
                                           class="form-control" id="inlineFormInputGroupUsername2"
                                           placeholder="ادخل كلمة البحث">
                                </div>
                                <label class="sr-only" for="role">اختر نوع</label>
                                <div class="input-group mb-2 mr-sm-2" style="margin-left: -2px;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">اختر نوع</div>
                                    </div>
                                    <select id="role" style="border-radius: 0" class="form-control"
                                            v-model="selected_role">
                                        <option value="">اختر نوع</option>
                                        <option v-for="role in roles" :value="role.name">{{ role.name }}</option>
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-secondary mb-2" @click.prevent="get_search_result">
                                    بحث
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3 text-right">
                            <router-link class="btn btn-primary"
                                         :to="{ path: '/admin/users/add'}">إضافة مستخدم جديد
                            </router-link>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="numeric">#</th>
                                <th class="">الاسم</th>
                                <th class="">البريد الالكتروني</th>
                                <th class="">النوع</th>
                                <th class="">اجراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(user,index) in users">
                                <td>{{ ++index }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.roles[0] ? user.roles[0].name : '' }}</td>

                                <td>
                                    <router-link style="padding: 4px" class="btn btn-light"
                                                 :to="{ path: '/admin/users/'+user.id}">
                                        <i class="icon-eye" style="color: rgb(78 78 78)"></i>
                                        عرض
                                    </router-link>
                                    <router-link style="padding: 4px" class="btn btn-success ml-1 mr-1" v-if="user.id !== 1"
                                                 :to="{ path: '/admin/users/edit/'+user.id}">
                                        <i class="icon-pencil7" style="color: white"></i>
                                        تعديل
                                    </router-link>
                                    <a href="javascript:void(0)" style="padding: 4px" class="btn btn-danger"  v-if="user.id !== 1" @click="delete_user(user.id,user.name)">
                                        <i class="icon-cross3"
                                           style="font-weight: bold;color: white"></i>
                                        حذف
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <vue-confirm-dialog></vue-confirm-dialog>
    </div>


</template>

<script>
export default {

    data() {
        return {
            users: [],
            roles: [],
            selected_role: '',
            search_value: '',
        }
    },
    mounted() {
        this.get_users();
        this.get_roles();

    },

    components: {},
    methods: {
        get_users() {
            axios.get('/vue/user').then((response) => {
                this.users = response.data.users;
            })
        },
        get_search_result() {
            axios.get('/vue/user?q=' + this.search_value + '&role=' + this.selected_role).then((response) => {
                this.users = response.data.users;
            })
        },
        get_roles() {
            axios.get('/vue/settings/roles').then((response) => {
                this.roles = response.data.roles;
            })
        },
        delete_user(id,name) {
            this.$confirm(
                {
                    title: 'تاكيد',
                    message: 'هل أنت متأكد من عملية الحذف "'+name+'" ?',
                    button: {
                        no: 'لا',
                        yes: 'نعم'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm
                     */
                    callback: confirm => {
                        if (confirm) {
                            axios.delete(
                                '/vue/user/' + id).then((response) => {
                                this.notify('success', 'تمت عملية الحذف بنجاح', 'fas fa-check p-1');
                                this.get_search_result();
                            }).catch(error => {
                                this.showError(error);
                            });
                        }
                    }
                }
            )

        },

        showError(error) {
            let message_title = error.response.data.message + '\n';
            let message = message_title;
            let errors = error.response.data.errors;
            $.each(errors, function (key, val) {
                $.each(val, function (key2, val2) {
                    message += val2 + '\n'
                });
            });
            this.notify("error", message, 'fas fa-times p-1', 'danger')
        },

    }
}
</script>
