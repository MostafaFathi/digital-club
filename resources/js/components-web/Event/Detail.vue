<template>
    <div>
        <section class="section-breadcrumb mt-header pt-4">
            <nav class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Event</a></li>
                    <li class="breadcrumb-item"><a href="#">On site workshop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Multidisciplinary Planning</li>
                </ol>
            </nav>
        </section>

        <section class="workshop-details">
            <div class="container">
                <h1 class="mb-4">Multidisciplinary Planning of Gummy Smile (Digital Approach)</h1>
                <div class="date-course d-md-flex align-items-center mb-4">
                    <label>Oct 14, 2022</label>
                    <a href="#">https://najtraining.com</a>
                </div>

                <div class="info-course mb-4">
                    <h3>Course information</h3>
                    <p>Digital approach from multidisciplinary treatment planning and aspect is becoming a standard for treating patient with gummy smile. the hand on workshop is on side at NAJ training center, including interaction with speaker, learning community and certificate with credit hours.</p>

                    <div class="info-label mb-3">
                        <label>Difficulty level</label><span>Medium</span>
                    </div>
                    <div class="info-label mb-3">
                        <label>Language</label><span>English</span>
                    </div>
                    <div class="info-label mb-3">
                        <label>Venue</label><span>NAJ Training center</span>
                    </div>
                    <div class="info-label">
                        <label>Location</label><span>Riyadh</span>
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
                                    <label class="pe-3 me-3">Dr. Dalia nourah</label>
                                    <label class="pe-3 me-3">Dr. Osamah Alsulimani</label>
                                    <label class="pe-3 me-3">Dr. Faris Khalifa</label>
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
                            <div class="accordion-body ps-0">
                                <ul>
                                    <li>The concept of multidisciplinary team</li>
                                    <li>Smile analysis to achieve the best result</li>
                                    <li>Integrated treatment plan sequence</li>
                                    <li>Digital workflow for the integrated case</li>
                                    <li>Clinical scenario for digital treatment</li>
                                    <li>planning of multi -disciplinary cases</li>
                                </ul>
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
                            <div class="accordion-body ps-0">
                                <h2>What does the program consist of ?</h2>
                                <p>Dentists with some experience in digital dentistry who are willing to master the digital workflow for gummy smile management utilizing such as guided plastic surgical stent, data acquisition, diagnosis and treatment planning and more </p>
                                <h2>What does the program consist of ?</h2>
                                <ul>
                                    <li>The concept of multidisciplinary team</li>
                                    <li>Smile analysis to achieve the best result</li>
                                    <li>Integrated treatment plan sequence</li>
                                    <li>Digital workflow for the integrated case</li>
                                    <li>Clinical scenario for digital treatment</li>
                                    <li>planning of multi -disciplinary cases</li>
                                </ul>
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
                                    <label class="pe-3 me-3">150 SAR</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-workshop mb-5">
                    <a href="#" class="btn btn-primary me-2">Register</a>
                    <a href="#" class="btn btn-outline-secondary">Learn more</a>
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

