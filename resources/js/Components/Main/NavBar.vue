<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <Link class="navbar-brand" :href="route('dashboard')">Dashboard</Link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <Link class="nav-link active" aria-current="page" :href="route('students')">Students List</Link>
            </li>
          </ul>

          <span v-if="auth.user">

            <form method="POST" :action="route('logout')" @submit.prevent="$inertia.post(route('logout'))">
              <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
          </span>
          <span v-else>

            <span class="mr-2">
              <Link :href="route('login')">Login</Link>
            </span>
            <span>
              <Link :href="route('register')" class="btn btn-success">Register</Link>
            </span>
          </span>
        </div>
      </div>
    </nav>
  </template>

  <script>
  import { Link } from '@inertiajs/inertia-vue3';

  export default {
    components: {
      Link,
    },
    computed: {
      auth() {
        return this.$page.props.auth;
      },
    },
  };
  </script>

  <style lang="scss" scoped>

  </style>
