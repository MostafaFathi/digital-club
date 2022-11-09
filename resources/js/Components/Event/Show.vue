<template>
    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">Home</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <router-link class="breadcrumb-item"  :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> الرئيسية
                        </router-link>
                        <router-link class="breadcrumb-item " :to="{ path: '/admin/teams'}">
                            <span class=" ">فرق العمل</span>
                        </router-link>
                        <span class="breadcrumb-item active"> {{ name }}</span>
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
                                    <label  class="font-weight-bold" >Name</label>
                                    <div>
                                        {{name}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="font-weight-bold" >Email</label>
                                    <div>
                                        {{email}}
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  class="font-weight-bold" >Mobile</label>
                                    <div>
                                        {{mobile}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="font-weight-bold" >Type/Role</label>
                                   <div>
                                       {{selected_role}}
                                   </div>
                                </div>
                            </div>
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
    async mounted() {
       await this.get_roles();
        await this.get_user();

    },

    components: {},
    methods: {
        get_roles() {
            axios.get('/vue/settings/roles').then((response) => {
                this.roles = response.data.roles;
            })
        },
        get_user() {
            var id = this.$route.params.id;
            axios.get('/vue/user/'+id).then((response) => {
                this.name = response.data.user.name;
                this.email = response.data.user.email;
                this.mobile = response.data.user.mobile;
                this.selected_role = response.data.user.roles[0].name;
            })
        },
        add_user() {
            axios.post(
                '/vue/user/store',
                {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    password: this.password,
                    selected_role: this.selected_role,
                }).then((response) => {

                this.notify('success',  'User added successfully', 'fas fa-check p-1');
            this.$router.push({
                    path: '/admin/users',
                })
            }).catch(error => {
                this.showError(error);
            });
            return false;
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
            this.notify("error", message, 'fas fa-times p-1','danger')
        },

    }
}
</script>
