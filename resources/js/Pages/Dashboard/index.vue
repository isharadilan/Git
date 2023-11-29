<template>
  <AppLayout>
    <template #content>
        <div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-title">Welcome to the Student Management System</h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8 mx-auto text-center">
            <p class="lead">Manage your students with our Student Management System. Keep track of student information, update records, and ensure a seamless educational experience.</p>
            <p>Features:</p>
            <ul class="list-unstyled">
                <li>Efficient student data management</li>
                <li>Quick access to student information</li>
                <li>Easy record updates</li>

            </ul>
        </div>
    </div>
</div>

    </template>
  </AppLayout>
</template>

<script>

import AppLayout from '@/Layouts/App.vue';

export default{
    components:{
        AppLayout
    }
}

</script>

<style lang="css" scoped>

</style>
