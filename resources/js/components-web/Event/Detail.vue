<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Event</a></li>
                    <li class="breadcrumb-item"><router-link :to="'/events/'+event.type">{{ event.type_name }}</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ event.name_limit }}</li>
                </ol>
            </nav>
        </section>

        <section class="workshop-details">
            <div class="container">
                <h1 class="mb-4">{{ event.name }}</h1>
                <div class="date-course d-md-flex align-items-center mb-4">
                    <label>{{ event.month_day }}, {{ event.year }}</label>
                    <a v-if="event.link" :href="event.link" target="_blank">{{ event.link }}</a>
                </div>

                <div class="info-course mb-4">
                    <h3>Course information</h3>
                    <p>{{ event.description }}</p>

                    <div class="info-label mb-3">
                        <label>Difficulty level</label><span>{{ event.difficulty }}</span>
                    </div>
                    <div class="info-label mb-3">
                        <label>Language</label><span>{{ event.language }}</span>
                    </div>
                    <div class="info-label mb-3">
                        <label>Venue</label><span>{{ event.venue }}</span>
                    </div>
                    <div class="info-label">
                        <label>Location</label><span>{{ event.location }}</span>
                    </div>
                </div>
                <div class="accordion accordion-flush mb-4" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-1">
                            <button class="accordion-button ps-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Speakers
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-heading-1" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body ps-0">
                                <div class="d-sm-flex">
                                    <label class="pe-3 me-3" v-for="item in event.speakers">{{item.name}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-2">
                            <button class="accordion-button ps-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Learning objectives
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-heading-2" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body ps-0" v-html="event.objectives">

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-3">
                            <button class="accordion-button ps-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Course details
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-heading-3" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body ps-0"  v-html="event.details">

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading-4">
                            <button class="accordion-button ps-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Course fees
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-heading-4" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body ps-0">
                                <div class="d-sm-flex">
                                    <label class="pe-3 me-3">{{ event.fees }} SAR</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-workshop mb-5">
                    <a href="/login" v-if="!is_logged_in" class="btn btn-primary me-2">You need to login</a>
                    <a href="javascript:void(0);" v-else-if="is_registered_before" disabled="true" class="btn btn-primary disabled me-2">{{is_registered_before_message}}</a>
                    <a href="javascript:void(0);" :disabled="loader" :class="['btn btn-primary  me-2',loader ? 'disabled' : '']"  v-else  @click="event_register">
                        <i class="spinner-border text-light" style="width: 20px;height: 20px;" v-if="loader"></i>
                        <span v-if="loader">Register, Please wait ...</span>
                        <span v-else>Register</span>
                        </a>
                    <a v-if="event.link" :href="event.link" target="_blank" class="btn btn-outline-secondary">Learn more</a>
                </div>
            </div>
        </section>

    </div>
</template>

<script>




export default {
    name: "Home",
    components: {},
    data() {
        return {
            content: 'main',
            loader: false,
            is_logged_in: false,
            is_registered_before: false,
            is_registered_before_message: null,
            event: {
                name: null,
                type: "",
                link: "",
                type_name: "",
                event_date: null,
                description: null,
                difficulty: null,
                language: null,
                venue: null,
                location: null,
                objectives: null,
                details: null,
                fees: null,
                month_day: null,
                year: null,
                speakers: [{name:''}]
            },
        }
    },
    mounted() {
        $("html, body").animate({scrollTop: 0});

        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()
        this.get_event()
    },
    methods: {
        get_event() {
            axios.get(
                '/api/website/event/' + this.$route.params.id+'/show').then((response) => {
                this.event = response.data.data
                this.is_logged_in = response.data.is_logged_in
                this.is_registered_before = response.data.is_registered_before
                this.is_registered_before_message = response.data.is_registered_before_message
            }).catch((error) => {

            });
        },
        event_register() {
            this.loader = true;
            axios.post(
                '/api/website/event/' + this.$route.params.id+'/register').then((response) => {
                this.loader = false;
                this.event = response.data.data
                this.is_logged_in = response.data.is_logged_in
                this.is_registered_before = response.data.is_registered_before
                this.is_registered_before_message = response.data.is_registered_before_message
            }).catch((error) => {

            });
        },
    }

}
</script>

