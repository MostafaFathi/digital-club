<template>
    <div>
        <section class="intro-digital-club position-relative">
            <!-- <img src="images/intro-dig.png"> -->
        </section>

        <div class="digital-club-title py-5 mb-5">
            <div class="container">
                <h1 class="mb-0">About the DDC</h1>
            </div>
        </div>

        <section class="digital-club-links p-5">
            <div class="container">
                <div class="row mx-md-5">
                    <div class="col-md-6 mb-5">
                        <div class="block-link position-relative d-inline-flex">
                            <img class="me-3" :src="'/portal/assets/images/sps-logo.svg'">
                            <div>
                                <h2>Who we are</h2>
                                <p>Our Purpose, Mission, Vision and Values</p>
                            </div>
                            <router-link to="/who-we-are" class="stretched-link"></router-link>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="block-link position-relative d-inline-flex">
                            <img class="me-3" :src="'/portal/assets/images/part.svg'">
                            <div>
                                <h2>Our partners</h2>
                                <p>Our founding and industry partners</p>
                            </div>
                            <router-link to="/partners" class="stretched-link"></router-link>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="block-link position-relative d-inline-flex">
                            <img class="me-3" :src="'/portal/assets/images/blog.svg'">
                            <div>
                                <h2>Blog</h2>
                                <p>Lastest news and articles</p>
                            </div>
<!--                            <a href="#" class="stretched-link"></a>-->
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="block-link position-relative d-inline-flex">
                            <img class="me-3" :src="'/portal/assets/images/info.svg'">
                            <div>
                                <h2>Information & media</h2>
                                <p>Press releases, videos, documents</p>
                            </div>
<!--                            <a href="#" class="stretched-link"></a>-->
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="block-link position-relative d-inline-flex">
                            <img class="me-3" :src="'/portal/assets/images/member.svg'">
                            <div>
                                <h2>Leadership</h2>
                                <p>Founding member</p>
                            </div>
                            <router-link to="/members" class="stretched-link"></router-link>
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

