<template>
    <div>
        <section class="create-account mt-header pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-5 col-md-5">
                        <ul class="label-steps list-unstyled p-0 position-fixed">
                            <li class="steps steps-1 "><i>1</i> Create free account</li>
                            <li class="steps steps-2 active"><i>2</i> Verify email address</li>
                            <li class="steps steps-3"><i>3</i> Free account confirmation</li>
                        </ul>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="form-account">
                            <div  class="box-step2" >
                                <h2 class="form-title">Verify email address</h2>
                                <p>An email message with a verification link has been sent to
                                    {{email}}.</p>
                                <p>Click the link in the message to continue with the registration process. If you can
                                    not find our verification message make sure to check your spam folder or click the
                                    button below to resend it.</p>
                                <button :class="['btn btn-primary',resend_disabled]"
                                        :disabled="resend_disabled"  @click="resend_verification" id="next-step3">
                                    <i class="spinner-border text-light" style="width: 20px;height: 20px;" v-if="resend_loader"></i>
                                    <span>Resend verification email</span>
                                    <span v-if="timerCount">
                                        ({{timerCount}})
                                    </span>

                                </button>
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
            email: null,
            loader: false,
            resend_loader: false,
            resend_disabled: null,
            timerCount: 60,
        }
    },
    mounted() {
        this.email = localStorage.verify_email_address
        this.resend_disabled = 'disabled';
        this.timer_count_down()
    },
    methods: {
        resend_verification() {
            this.resend_loader = true;
            this.resend_disabled = 'disabled';
            axios.post(
                '/api/website/member/resend-verification-email',
                this.user).then((response) => {
                this.resend_loader = false;
                this.resend_disabled = null;
                this.timerCount = 120;
                this.timer_count_down()

            }).catch((error) => {
                this.resend_loader = false;
                this.resend_disabled = null;
                let message = '';
                let errors = error.response.data.errors;
                $.each(errors, function (key, val) {
                    message += val + '</br>'
                });

                this.$swal.fire({
                    position: 'center',
                    title: null,
                    html: message,
                    icon: 'error',
                    iconHtml: 'X',
                    showConfirmButton: false,
                })


            });

        },
        timer_count_down() {
            if (this.timerCount > 0) {
                setTimeout(() => {
                    this.timerCount--;
                    this.timer_count_down()
                }, 1000);
            } else {
                this.resend_again = true;
                this.resend_disabled = null;
            }
        }

    }


}
</script>

