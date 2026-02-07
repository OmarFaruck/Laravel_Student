<template>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100" :class="{ 'd-none': !showSidebar }" style="width:260px">
      <h5 class="mb-4">Dashboard</h5>

      <ul class="nav flex-column gap-2">
        <li>
          <Link href="/" class="nav-link text-white">
            Dashboard pages
          </Link>
        </li>

        <li>
          <Link href="/shops" class="nav-link text-white">
            Shop Page Laravel + Vue
          </Link>
        </li>

        <li>
          <Link href="/customers" class="nav-link text-white">
            Customer Page Laravel + Vue
          </Link>
        </li>

        <li>
          <Link href="/admins" class="nav-link text-white">
            Admin Page Laravel + Vue
          </Link>
        </li>

        <li>
          <Link href="/register_page" class="nav-link text-white">
            Register Page 
          </Link>
        </li>

        <li class="mt-3">
          <Link href="/logout_page" class="btn btn-outline-danger">
            Logout
          </Link>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
      <!-- Top Bar -->
      <nav class="navbar navbar-light bg-light px-3">
        <button class="btn btn-outline-primary" @click="toggleSidebar">
          ☰
        </button>

        <span class="ms-auto fw-bold">
          {{ $page.props.auth?.user?.name }}
        </span>
      </nav>

      <!-- Flash Message -->
      <div class="container mt-3">
        <div v-if="$page.props.flash?.success" class="alert alert-success">
          {{ $page.props.flash.success }}
        </div>

        <div v-if="$page.props.flash?.error" class="alert alert-danger">
          {{ $page.props.flash.error }}
        </div>
      </div>

      <!-- Page Content -->
      <main class="p-4">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const showSidebar = ref(true)

const toggleSidebar = () => {
  showSidebar.value = !showSidebar.value
}
</script>
