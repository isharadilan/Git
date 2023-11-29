
<template>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <Link class="navbar-brand" :href="route('dashboard')">NavBar</Link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">

                    <Link class="nav-link active" aria-current="page" :href="route('students')">Students List</Link>
                </li>
            </ul>



            <span class="mr-2">
                <Link :href="route('login')"> Login </Link>
            </span>
            <span>
                <Link :href="route('register')" class="btn btn-success">Register</Link>
                </span>


        </div>
    </div>
</nav>


</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'

export default{
    components: {
        Link
    }
}

</script>

<style lang="css" scoped>

</style>

















