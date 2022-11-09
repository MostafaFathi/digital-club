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
                        <router-link class="breadcrumb-item" :to="{ path: '/admin'}">
                            <i class="icon-home2 mr-2"></i> Home
                        </router-link>
                        <router-link class="breadcrumb-item " :to="{ path: '/admin/employees'}">
                            <span class=" ">Events</span>
                        </router-link>
                        <span class="breadcrumb-item active">Add event</span>
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
                        <div class="row mt-4 mb-4" style="padding:5px;border-bottom: 1px solid #e1e1e1;">
                            <h5 class="font-weight-bold"> Course information</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="event.name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" v-model="event.description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" v-model="event.event_date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" class="form-control" v-model="event.link">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" v-model="event.type">
                                        <option value="" selected> -Select-</option>
                                        <option v-for="item in event_types" :value="item.id"> {{
                                                item.name
                                            }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Difficulty</label>
                                    <select class="form-control" v-model="event.difficulty">
                                        <option value="" selected> -Select-</option>
                                        <option v-for="item in difficulty_types" :value="item.id"> {{
                                                item.name
                                            }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Language</label>
                                    <select class="form-control" v-model="event.language">
                                        <option value="" selected> -Select-</option>
                                        <option value="ar" selected>Arabic</option>
                                        <option value="en" selected>English</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Venue</label>
                                    <input type="text" class="form-control" v-model="event.venue">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" v-model="event.location">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4" style="border-bottom: 1px solid #e1e1e1;">
                            <h5 class="font-weight-bold"> Speakers</h5>
                        </div>
                        <div :class="['row', 'mt-2']" v-for="(item,index) in event.speakers"
                             :style="'background-color:'+(index%2===1 ? '#fafafa;' : '')">
                            <div class="col-md-6">
                                <div class="form-group p-2">
                                    <label for="from">Speaker ({{ index + 1 }})</label>
                                    <input type="text" id="from" v-model="item.name" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-12"> &nbsp;</label>
                                    <a href="#" class="btn btn-danger" v-if="index > 0"
                                       @click.prevent="remove_speaker(index)">Remove</a>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3 pb-2" style="border-bottom: 1px solid #e1e1e1;">
                            <div class="col-md-2">
                                <a href="#" class="btn btn-info" @click.prevent="add_new_speaker">
                                    <i class="icon-plus-circle2"></i>
                                    + More speaker
                                </a>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4" style="padding:5px;border-bottom: 1px solid #e1e1e1;">
                            <h5 class="font-weight-bold"> Learning objectives</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <VueEditor v-model="event.objectives"></VueEditor>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4" style="padding:5px;border-bottom: 1px solid #e1e1e1;">
                            <h5 class="font-weight-bold"> Course details</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <VueEditor v-model="event.details"></VueEditor>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4 mb-4" style="padding:5px;border-bottom: 1px solid #e1e1e1;">
                            <h5 class="font-weight-bold"> Fees details</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fees</label>
                                    <input type="tel" class="form-control" v-model="event.fees">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <button class="btn btn-success" @click.prevent="item_store">Add Event</button>
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
            event: {
                name: null,
                type: "",
                link: "",
                event_date: null,
                description: null,
                difficulty: null,
                language: null,
                venue: null,
                location: null,
                objectives: null,
                details: null,
                fees: null,
                speakers: [{name:''}]
            },
            name: '',
            event_types: [
                {id: 'live-webinars', name: 'Live webinars'},
                {id: 'cad', name: 'CAD recording techniques'},
                {id: 'workshop', name: 'On site workshop'},
            ],
            difficulty_types: [
                {id: 'easy', name: 'Easy'},
                {id: 'medium', name: 'Medium'},
                {id: 'hard', name: 'Hard'},
            ],
        }
    },
    async mounted() {
        await this.prepare_select('selected_users');
    },


    methods: {
        item_store() {


            this.loader = true;
            this.disabled = 'disabled';
            const config = {headers: {'Content-Type': 'multipart/form-data'}};
            const formData = new FormData();
            formData.append('name', this.event.name);
            formData.append('link', this.event.link);
            formData.append('description', this.event.description);
            formData.append('event_date', this.event.event_date);
            formData.append('type', this.event.type);
            formData.append('difficulty', this.event.difficulty);
            formData.append('language', this.event.language);
            formData.append('venue', this.event.venue);
            formData.append('location', this.event.location);
            formData.append('objectives', this.event.objectives);
            formData.append('details', this.event.details);
            formData.append('fees', this.event.fees);
            formData.append('speakers', JSON.stringify(this.event.speakers));
            axios.post(
                '/vue/admin/event/store',
                formData, config).then((response) => {
                this.notify('Success', 'Event added successfully', 'fas fa-check p-1');

                this.event = {
                    name: null,
                    type: "",
                    event_date: null,
                    description: null,
                    difficulty: null,
                    language: null,
                    venue: null,
                    location: null,
                    objectives: null,
                    details: null,
                    fees: null,
                    speakers: ['']
                };

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
        add_new_speaker(e) {
            this.event.speakers.push({name:''})
            return false;
        },
        remove_speaker(index) {
            this.event.speakers.splice(index, 1)
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
