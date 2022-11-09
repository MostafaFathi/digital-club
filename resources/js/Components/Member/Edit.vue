<template>
    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">Members</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <router-link class="breadcrumb-item" :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> Home
                        </router-link>
                        <router-link class="breadcrumb-item " :to="{ path: '/admin/members'}">
                            <span class=" ">Members</span>
                        </router-link>
                        <span class="breadcrumb-item active">Edit member</span>
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
                                    <label>First name</label>
                                    <input type="text" class="form-control" v-model="member.first_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" v-model="member.last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="member.email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Postal address</label>
                                    <input type="text" class="form-control" v-model="member.postal_address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profession</label>
                                    <input type="text" class="form-control" v-model="member.profession">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <button class="btn btn-success" @click.prevent="item_update">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {VueEditor} from "vue2-editor";

export default {
    components: {VueEditor},
    data() {
        return {
            member: {
                first_name: null,
                last_name: "",
                email: "",
                postal_address: null,
                profession: null,
            },
        }
    },
    async mounted() {
        this.get_event();
    },


    methods: {
        get_event() {
            axios.get(
                '/vue/admin/member/'+this.$route.params.id).then((response) => {
                this.loader = false;
                this.member = response.data.data
            }).catch((error) => {

            });
        },
        item_update() {
            this.loader = true;
            this.disabled = 'disabled';
            const config = {headers: {'Content-Type': 'multipart/form-data'}};
            axios.post(
                '/vue/admin/member/'+this.$route.params.id+'/update',
                this.member, config).then((response) => {
                this.notify('Success', 'Member Updated successfully', 'fas fa-check p-1');

                this.$router.push({
                    path: '/admin/members',
                })

            }).catch((error) => {
                this.showError(error);


            });
            return false;

        },
        prepare_select(select) {
            var vm = this;
            $('.' + select).select2({
                tags: true,
                tokenSeparators: [',', ' ']
            }).on('change', function () {
                vm[select] = $(this).val();
                // this.selected_tags = e.params.data.id;
            })
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
