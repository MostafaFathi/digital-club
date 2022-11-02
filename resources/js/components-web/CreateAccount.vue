<template>
    <div>
        <section class="create-account mt-header pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-5 col-md-5">
                        <ul class="label-steps list-unstyled p-0 position-fixed">
                            <li class="steps steps-1 active mt-0"><i>1</i> Create free account</li>
                            <li class="steps steps-2"><i>2</i> Verify email address</li>
                            <li class="steps steps-3"><i>3</i> Free account confirmation</li>
                        </ul>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="form-account">
                            <div class="box-step1">
                                <h1 class="form-title">Create Free Account</h1>
                                <div class="mb-3">
                                    <label class="form-label">First name <span>*</span></label>
                                    <input type="text" v-model="user.first_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last name <span>*</span></label>
                                    <input type="text" v-model="user.last_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email <span>*</span></label>
                                    <input type="email" v-model="user.email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Postal address <span>*</span></label>
                                    <input type="text" v-model="user.postal_address" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Profession <span>*</span></label>
                                    <select class="form-control" v-model="user.profession">
                                        <option selected></option>
                                        <option value="dentist">Dentist</option>
                                        <option value="Dental Technician">Dental Technician</option>
                                        <option value="Dental Hygienist">Dental Hygienist</option>
                                        <option value="Dental Assistant/Nurse">Dental Assistant/Nurse</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password <span>*</span></label>
                                    <input type="password" v-model="user.password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password (repeat) <span>*</span></label>
                                    <input type="password" v-model="user.password_confirmation" class="form-control">
                                </div>
                                <div class="form-check mb-2 d-table">
                                    <input class="form-check-input" type="checkbox" v-model="user.policy_accept" value="" id="flexCheckDefault">
                                    <label class="form-check-label flexCheckDefault"  for="flexCheckDefault">
                                        I accept the:
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <a class="d-table" href="#">Privacy Policy</a>
                                    <a class="d-table" href="#">Terms of Use</a>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-primary" :class="['btn btn-primary ',disabled]"
                                            :disabled="disabled" @click="create_account" id="next-step2">
                                        <i class="spinner-border text-light" style="width: 20px;height: 20px;" v-if="loader"></i>
                                        Continue
                                    </button>
                                </div>
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
            user: {
                first_name: null,
                last_name: null,
                email: null,
                postal_address: null,
                profession: null,
                password: null,
                password_confirmation: null,
                policy_accept: false,
            },
            disabled: null,
            loader: false,
            verify_email: false,
        }
    },
    methods: {
        create_account() {
            console.log(this.user.policy_accept,'this.user.policy_accept')
            if (!this.user.policy_accept) {
                $('.flexCheckDefault').css('color', 'red');
                return false;
            }
            $('.flexCheckDefault').css('color', '');
            this.loader = true;
            this.disabled = 'disabled';
            axios.post(
                '/api/website/member/register',
                this.user).then((response) => {
                this.loader = false;
                this.disabled = null;
                localStorage.setItem('verify_email_address',this.user.email)
                this.$router.push({
                    name:'verify-account'
                })
                this.user = {
                    first_name: null,
                    last_name: null,
                    email: null,
                    postal_address: null,
                    profession: null,
                    password: null,
                    confirm_password: null,
                    policy_accept: false,
                }

            }).catch((error) => {
                this.loader = false;
                this.disabled = null;
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

        }
    }


}
</script>

