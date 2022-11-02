<template>
    <div>
        <section class="intro-digital-club position-relative">
            <!-- <img src="images/intro-dig.png"> -->
        </section>

        <div class="digital-club-title py-5 mb-5">
            <div class="container">
                <h1>Events</h1>
                <p>From basic to advance level</p>
            </div>
        </div>

        <section class="digital-club-links p-4">
            <div class="container">
                <div class="row mx-md-5">
                    <div class="col-md-6 mb-5">
                        <div class="block-link position-relative d-inline-flex align-items-center">
                            <img class="me-3" :src="'portal/assets/images/live.svg'">
                            <h2 class="mb-0">Live webinars</h2>
                            <a href="#" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="block-link position-relative d-inline-flex align-items-center">
                            <img class="me-3" :src="'portal/assets/images/cad.png'">
                            <h2 class="mb-0">CAD recording techniques</h2>
                            <a href="#" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="block-link position-relative d-inline-flex align-items-center">
                            <img class="me-3" :src="'portal/assets/images/workshop.png'">
                            <h2 class="mb-0">On site workshop</h2>
                            <a href="#" class="stretched-link"></a>
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
            selected_category:{}
        }
    }

}
</script>

