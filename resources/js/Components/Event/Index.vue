<template>
    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">Events</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <router-link class="breadcrumb-item"  :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> Home
                        </router-link>
                        <span class="breadcrumb-item active">Events</span>
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

                                <label class="sr-only" for="inlineFormInputGroupUsername2">Enter a word</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Search by event name</div>
                                    </div>
                                    <input type="text" style="border-radius: 0" v-model="search_value"
                                           class="form-control" id="inlineFormInputGroupUsername2"
                                           placeholder="Search by event name">

                                </div>
                                <div class="input-group mb-2 mx-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Event type</div>
                                    </div>
                                    <select name="" id="" class="form-control" v-model="event_type_id">
                                        <option value="" selected>Select</option>
                                        <option v-for="item in event_types" :value="item.id">{{item.name}}</option>
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-secondary mb-2 mr-1 ml-1"
                                        @click.prevent="get_events">
                                    Search
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3 text-right">
                            <router-link class="btn btn-primary"
                                         :to="{ path: '/admin/events/add'}">Add Event
                            </router-link>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Link</th>
                                <th class="" style="width: 140px;">Control</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in items">
                                <td>{{ item.name }}</td>
                                <td>{{ item.type_name }}</td>
                                <td>{{ item.event_date }}</td>
                                <td>
                                    <a :href="item.link" :title="item.link" target="_blank" v-if="item.link">{{ item.link_limit }}</a>
                                    <span v-else>--</span>
                                </td>
                                <td style="padding: 0;">
                                    <router-link  style="padding: 4px" class="btn btn-success"
                                                 :to="{ path: '/admin/events/edit/'+item.id}">
                                        <i class="icon-pencil7" style="color: white"></i>
                                        Edit
                                    </router-link>
                                    <a href="javascript:void(0)" style="padding: 4px" class="btn btn-danger"  @click="delete_team(item.id,item.name)">
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
            event_types: [
                {id:'live-webinars',name:'Live webinars'},
                {id:'cad',name:'CAD recording techniques'},
                {id:'workshop',name:'On site workshop'},
            ],
            event_type_id: '',
            search_value: '',
        }
    },
    mounted() {
        this.get_events();

    },

    components: {},
    methods: {
        get_events(page = 1) {
            axios.get('/vue/admin/event?q=' + this.search_value +'&event_type_id=' + this.event_type_id + '&page=' + page).then((response) => {
                this.items = response.data.data;
            })
        },
        get_search_result() {
            axios.get('/vue/admin/event?q=' + this.search_value +'&event_type_id=' + this.event_type_id).then((response) => {
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
                                '/vue/admin/event/' + id).then((response) => {
                                this.notify('success', 'Event deleted successfully', 'fas fa-check p-1');
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
