<template>
    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">اضافة مستخدم</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <router-link class="breadcrumb-item"  :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> الرئيسية
                        </router-link>
                        <router-link class="breadcrumb-item " :to="{ path: '/admin/users'}">
                            <span class=" ">المستخدمين</span>
                        </router-link>
                        <span class="breadcrumb-item active">اضافة جديد</span>
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
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" id="name" v-model="name" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الالكتروني</label>
                                    <input type="email" id="email" v-model="email" class="form-control"/>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label for="mobile">Mobile</label>-->
<!--                                    <input type="number" id="mobile" v-model="mobile" class="form-control"/>-->
<!--                                </div>-->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">كلمة السر</label>
                                    <input type="password" id="password" v-model="password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="role">النوع</label>
                                    <select id="role" class="form-control" v-model="selected_role">
                                        <option value="">اختر نوع</option>
                                        <option v-for="role in roles" :value="role.name">{{ role.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <button class="btn btn-success" @click.prevent="add_user">حفظ</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            roles: [],
            name: '',
            email: '',
            mobile: '',
            password: '',
            selected_role: '',
        }
    },
    mounted() {
        this.get_roles();

    },

    components: {},
    methods: {
        get_roles() {
            axios.get('/vue/settings/roles').then((response) => {
                this.roles = response.data.roles;
            })
        },
        add_user(e) {
            axios.post(
                '/vue/user/store',
                {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    password: this.password,
                    selected_role: this.selected_role
                },{headers:{'e':e}}).then((response) => {

                this.notify('success', 'User added successfully', 'fas fa-check p-1');
                this.$router.push({
                    path: '/admin/users',
                })
            }).catch(error => {
                this.showError(error);
            });
            return false;
        },
        update_role() {
            var id = this.selected_role.id;
            axios.post(
                '/vue/settings/roles/' + id + '/update',
                {
                    name: this.selected_role.name,
                    permissions: this.selected_role_permissions
                }).then((response) => {
                this.roles = response.data.roles;
                this.update_operation = true
                this.add_operation = false
                this.notify('success', 'Updated successfully', 'fas fa-check p-1');
            }).catch(error => {
                this.showError(error);
            });
        },
        delete_role(id) {
            axios.delete(
                '/vue/settings/roles/' + id + '/destroy').then((response) => {
                this.notify('success', 'Deleted successfully', 'fas fa-check p-1');
                this.roles = response.data.roles;
                this.selected_role = response.data.selected_role;
                this.selected_role_permissions = response.data.permissions;
                this.update_operation = true
                this.add_operation = false
            }).catch(error => {
                this.showError(error);
            });
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
