<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="/">Home</router-link>
                    </li>
                    <li class="breadcrumb-item">
                        <router-link to="/who-we-are">About</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Founding member</li>
                </ol>
            </nav>
        </section>

        <section class="digital-club">

            <div class="title-memer mb-5">
                <div class="container">
                    <h1>Founding member</h1>
                </div>
            </div>

            <div class="digital_club_memer">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt.svg'">
                                <h2 class="mb-0">Dr. Ala’a Al Otaibi</h2>
                                <label>Prsident Prosthodontic consultant</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt1.jpg'">
                                <h2 class="mb-0">Dr. Abdulmalik Alyahya </h2>
                                <label>Oral and Maxillofacial Surgeon Fellow of facial plastic surgery</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt.svg'">
                                <h2 class="mb-0">Dr. Faris Al Khalifa </h2>
                                <label>RESTORATIVE consultant / Implantologist</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt2.jpg'">
                                <h2 class="mb-0">Dr.Dalia Noura </h2>
                                <label>periodontist / Assistant prof</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt3.jpg'">
                                <h2 class="mb-0">Dr. Hussam Mutwali </h2>
                                <label>Prosthodontic Consultant</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt4s.jpg'">
                                <h2 class="mb-0">Dr. Abdulaziz Al-Blaihess </h2>
                                <label>Periodontist/Assistant prof</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt5.jpg'">
                                <h2 class="mb-0">Dr. Heyam AlFallaj </h2>
                                <label>Prosthodontic Consultant</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt6.jpg'">
                                <h2 class="mb-0">Dr. Wala’ Majdi </h2>
                                <label>Prosthodontist Assistant prof</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-5 text-center">
                            <div class="h-100">
                                <img class="mb-3" :src="'/portal/assets/images/avt7.jpg'">
                                <h2 class="mb-0">Thamer alaswad </h2>
                                <label>Prosthodontic consultant</label>
                            </div>
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

