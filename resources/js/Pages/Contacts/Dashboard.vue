<template>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-3">
                <a href="/shops" class="btn btn-outline-info" style="text-decoration: none; margin-right: 15px">
                    <h3 style="text-decoration: none; color: black">
                        Shop Page Laravel + Vue
                    </h3>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/customers" class="btn btn-outline-success" style="text-decoration: none; margin-right: 15px">
                    <h3 style="text-decoration: none; color: blue">
                        Customer Page Laravel + Vue
                    </h3>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/student" class="btn btn-outline-secondary" style="text-decoration: none; color: green">
                    <h1>Student Page AI Crud</h1>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="/admins" class="btn btn-outline-primary" style="text-decoration: none; color: black">
                    <h1>Admin Page AI Crud</h1>
                </a>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <!-- <a :href="route('socialite.redirect', 'github')" class="btn btn-outline-success"> -->
                <a href="/auth/github" class="btn btn-outline-success">
                  
                    <Github /> 
                </a>
            </div>
            <div class="col-lg-4">
                <a href="/register_page" class="btn btn-outline-primary">Register_Page</a>
            </div>

            <div class="col-lg-4">
                <a href="/logout_page" class="btn btn-outline-danger"> <KeySquare /> Logout_Page</a>
            </div>
        </div>



    </div>
</template>

<script setup>
import { Github, KeySquare } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>
