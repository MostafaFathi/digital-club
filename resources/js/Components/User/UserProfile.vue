<template xmlns="http://www.w3.org/1999/html">
    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">بياناتي</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <router-link class="breadcrumb-item"  :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> الرئيسية
                        </router-link>
                        <span class="breadcrumb-item active">بياناتي</span>
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
                    <form action="" method="post" autocomplete="off">
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">كلمة السر</label>
                                    <input type="password" autocomplete="new-password" id="password" v-model="password" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <button class="btn btn-success" @click.prevent="update_user">حفظ</button>
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
            name: '',
            email: '',
            mobile: '',
            password: '',
        }
    },
    async mounted() {
        $('.navbar-nav .dropdown,.navbar-nav .dropdown-menu').removeClass('show')
        await this.get_user_profile();

    },

    components: {},
    methods: {
        get_user_profile() {
             axios.get('/vue/user/profile').then((response) => {
                this.name = response.data.user.name;
                this.email = response.data.user.email;
            })
        },
        update_user(e) {
            axios.post(
                '/vue/user/profile',
                {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                },{headers:{'e':e}}).then((response) => {
                $('.auth_user_name').text(this.name)
                this.notify('success', 'تم تحديث بياناتك بنجاح', 'fas fa-check p-1');

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
            this.notify("error", message, 'fas fa-times p-1', 'danger')
        },

    }
}
</script>
