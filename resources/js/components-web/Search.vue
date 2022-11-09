<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search</li>
                </ol>
            </nav>
        </section>


        <section class="workshop py-5 h-100">
            <div class="container"  v-if="events.length">
                <div class="item-workshop mb-4 position-relative" v-for="(item,index) in events">
                    <div class="row align-items-center">
                        <div class="col-md-2 col-sm-4  border-right text-center my-3">
                            <label>
                                {{ item.month_day }}
                                <span>{{ item.year }}</span>
                            </label>
                        </div>
                        <div class="col-md-10 col-sm-8">
                            <h5 class="ps-3">{{ item.type_name }}</h5>
                            <h3 class="ps-3">{{ item.name }}</h3>
                        </div>
                    </div>
                    <router-link :to="'/events/'+item.type+'/details/'+item.id" class="stretched-link"></router-link>
                </div>
            </div>
            <div class="container" v-else>
                <div class="item-workshop mb-4 position-relative" >
                    <div class="row align-items-center">

                        <div class="col-md-12 col-sm-12">
                            <h3  style="text-align: center;padding: 20px;">No data match</h3>
                        </div>
                    </div>
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
        this.get_events();
        $("html, body").animate({scrollTop: 0});

        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()
        next();
    },
    mounted() {
        this.event_type = this.$route.params.type
        this.get_events();
        $("html, body").animate({scrollTop: 0});

        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()
    },
    methods: {
        get_events() {
            console.log(this.$root.general_search,'this.$root.general_search')
            if (!this.$root.general_search) return false;
            axios.get(
                '/api/website/event/search/query?q='+this.$root.general_search).then((response) => {
                this.loader = false;
                this.events = response.data.data
            }).catch((error) => {

            });
        },
    }

}
</script>

