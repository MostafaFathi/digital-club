<template>
    <div>
        <section class="login mt-header pt-4 w-75 mx-auto">
            <div class="container">
                <h2>Welcome</h2>
                <h1>Log in with your DDC account</h1>
                <div class="form-account mt-4 w-75 m-auto">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="d-md-flex my-3 pb-3 border-bottom">
                        <button class="btn btn-primary me-3">Sing In</button>
                        <a href="#" class="btn btn btn-outline-secondary me-3">Forgot password</a>
                        <a href="#" class="btn btn btn-outline-secondary">Create account</a>
                    </div>
                    <div class="mb-4">
                        <a href="#" class="btn-contact">Contact DDC</a>
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

