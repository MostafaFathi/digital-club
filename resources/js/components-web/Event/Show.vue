<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Event</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ event_type_name }}</li>
                </ol>
            </nav>
        </section>

        <section class="workshop-intro mb-5">
            <div class="container">
                <h1>{{ event_type_name }}</h1>
                <p>{{ event_type_description }}</p>
            </div>
        </section>

        <section class="workshop py-5 h-100">
            <div class="container">
                <div class="item-workshop mb-4 position-relative" v-for="(item,index) in events">
                    <div class="row align-items-center">
                        <div class="col-md-2 col-sm-4  border-right text-center my-3">
                            <label>
                                {{item.month_day}}
                                <span>{{ item.year }}</span>
                            </label>
                        </div>
                        <div class="col-md-10 col-sm-8">
                            <h3 class="ps-3">{{ item.name }}</h3>
                        </div>
                    </div>
                    <router-link :to="'/events/'+$route.params.type+'/details/'+item.id" class="stretched-link"></router-link>
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
            event_type_name: '',
            event_type: '',
            event_type_description: '',
            events: [],
            event_types: [
                {
                    id: 'live-webinars',
                    name: 'Live webinars',
                    description: ''
                },
                {id: 'cad', name: 'CAD recording techniques', description: ''},
                {
                    id: 'workshop',
                    name: 'On site workshop',
                    description: 'Hand workshop courses from the renowned providers in the field'
                },
            ],
        }
    },


    beforeRouteUpdate(to, from, next) {
        this.event_type = to.params.type
        this.get_event_type_name();
        this.get_events();
        $("html, body").animate({scrollTop: 0});

        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()
        next();
    },
    mounted() {
        this.event_type = this.$route.params.type
        this.get_event_type_name();
        this.get_events();
        $("html, body").animate({scrollTop: 0});

        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()
    },
    methods: {
        get_events() {
            axios.get(
                '/api/website/event/' + this.event_type).then((response) => {
                this.loader = false;
                this.events = response.data.data
            }).catch((error) => {

            });
        },
        get_event_type_name() {
            this.event_types.forEach((item) => {
                if (this.event_type == item.id) {
                    this.event_type_name = item.name
                    this.event_type_description = item.description
                }

            })
        }
    }

}
</script>

