<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/who-we-are">About</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Who we are</li>
                </ol>
            </nav>
        </section>

        <section class="workshop-intro mb-5">
            <div class="container">
                <h1>Who we are</h1>
                <p>The DDC is a Saudi association of professional in digital dentistry. the objective of the DDC to provide a digital resources for dentists and dental students</p>
            </div>
        </section>

        <section class="about-us py-5 h-100">
            <div class="container">
                <div class="row gx-md-5">
                    <div class="col-md-4 mb-4">
                        <div class="about-us-card bg-white px-4 py-5 h-100">
                            <h2>Our mission</h2>
                            <ul>
                                <li>To Provide easy access up to date clinical and scientific knowled dentistry.</li>
                                <li>To improve the ability to treat patients in best way.</li>
                                <li>To Build a community for sharing expertise.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="about-us-card bg-white px-4 py-5 h-100">
                            <h2>Our purpose</h2>
                            <p>To provide guide and evidence on available computer aided designing (CAD) & computer aided manufacturing (CAM) technology involved in dental digital workflows to help practitioner to decide their own CAD/CAM tools in unbiased approach.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="about-us-card bg-white px-4 py-5 h-100">
                            <h2>Our vision</h2>
                            <p>Provide digital resources for dentist and dental students.</p>
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
    },
    mounted() {
        $("html, body").animate({scrollTop: 0});
        if ($('.navbar-toggler').attr('aria-expanded') !== 'false')
            $('.navbar-toggler').click()

    }

}
</script>

