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
                        <router-link class="breadcrumb-item"  :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> Home
                        </router-link>
                        <span class="breadcrumb-item active">Members</span>
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
                        <div class="col-md-12">
                            <form class="form-inline">

                                <label class="sr-only" for="inlineFormInputGroupUsername2">Enter a word</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Search by member name</div>
                                    </div>
                                    <input type="text" style="border-radius: 0" v-model="search_value"
                                           class="form-control" id="inlineFormInputGroupUsername2"
                                           placeholder="Search by member name">

                                </div>
                                <div class="input-group mb-2 mx-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Event</div>
                                    </div>
                                    <select name="" id="" class="form-control" v-model="event_id">
                                        <option value="" selected>Select</option>
                                        <option v-for="item in events" :value="item.id">{{item.name}}</option>
                                    </select>

                                </div>
                                <button type="submit" class="btn btn-secondary mb-2 mr-1 ml-1"
                                        @click.prevent="get_search_result">
                                    Search
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Postal address</th>
                                <th scope="col">Profession</th>
                                <th class="" style="width: 140px;">Control</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in items">
                                <td>{{ item.full_name }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.postal_address }}</td>
                                <td>{{ item.profession }}</td>
                                <td style="padding: 0;">
                                    <router-link  style="padding: 4px" class="btn btn-success"
                                                 :to="{ path: '/admin/members/edit/'+item.id}">
                                        <i class="icon-pencil7" style="color: white"></i>
                                        Edit
                                    </router-link>
                                    <a href="javascript:void(0)" style="padding: 4px" class="btn btn-danger"  @click="delete_team(item.id,item.full_name)">
                                        <i class="icon-cross3"
                                           style="font-weight: bold;color:white"></i>
                                        Delete
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
            items: [],
            events: [],
            search_value: '',
            event_id: '',
        }
    },
    mounted() {
        this.get_members();

    },

    components: {},
    methods: {
        get_members(page = 1) {
            axios.get('/vue/admin/member?q=' + this.search_value + '&event_id=' + this.event_id + '&page=' + page).then((response) => {
                this.items = response.data.data;
                this.events = response.data.events;
            })
        },
        get_search_result() {
            axios.get('/vue/admin/member?q=' + this.search_value + '&event_id=' + this.event_id ).then((response) => {
                this.items = response.data.data;
            })
        },
        delete_team(id,name) {
            this.$confirm(
                {
                    title: 'Confirm',
                    message: 'Do you sure to delete "'+name+'" ?',
                    button: {
                        no: 'No',
                        yes: 'Yes'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm
                     */
                    callback: confirm => {
                        if (confirm) {
                            axios.delete(
                                '/vue/admin/member/' + id).then((response) => {
                                this.notify('success', 'Member deleted successfully', 'fas fa-check p-1');
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
