<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Membership</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Become a Member</li>
                </ol>
            </nav>
        </section>

        <section class="intro-join mb-5">
            <div class="container">
                <h1>Become a DDC Member</h1>
                <p>Join more than 18,000 Members and Fellows in over 100 countries!</p>
                <router-link to="/create-account" class="btn btn-primary d-table m-auto">Register for a free DDC account</router-link>
            </div>
        </section>

        <section class="why-join py-5">
            <div class="container">
                <h2>Why joining the DDC Community ?</h2>
                <div class="row">
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="card-join bg-white px-4 py-5 h-100">
                            <img :src="'portal/assets/images/join1.svg'">
                            <p>Discover the guided and evidence available computer aided design and computer aided manufacturing in order to provide the best available care for your patients.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="card-join bg-white px-4 py-5 h-100">
                            <img :src="'portal/assets/images/join2.svg'">
                            <p>Build your reputation as speaker, researcher and clinician.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="card-join bg-white px-4 py-5 h-100">
                            <img :src="'portal/assets/images/join3.svg'">
                            <p>Build a community and network for sharing expertise.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="card-join bg-white px-4 py-5 h-100">
                            <img :src="'portal/assets/images/join4.svg'">
                            <p>provide an easy access to clinical and scientific database on digital dentistry.</p>
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

