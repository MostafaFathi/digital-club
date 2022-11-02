<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/who-we-are">About</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Our partners</li>
                </ol>
            </nav>
        </section>

        <section class="workshop-intro mb-5">
            <div class="container">
                <h1>Our partners</h1>
            </div>
        </section>

        <section class="partners py-5 h-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <a href="#" class="partners-link d-block h-100">
                            <img :src="'portal/assets/images/p1.png'">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="partners-link d-block h-100">
                            <img :src="'portal/assets/images/p2.png'">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="partners-link d-block h-100">
                            <img :src="'portal/assets/images/p3.png'">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="partners-link d-block h-100">
                            <img :src="'portal/assets/images/p4.png'">
                        </a>
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
            selected_category: {}
        }
    },
    mounted() {
        $("html, body").animate({scrollTop: 0});
        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()
    }

}
</script>

