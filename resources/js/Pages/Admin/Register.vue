<template>
    <div class="signup-wrapper">
        <div class="signup-card">
            <h2 class="title">Signup</h2>

            <form @submit.prevent="handleSignup">
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" class="form-control" placeholder="Name" v-model="form.name" id="name"/>
                    <div v-if="errors.name">{{ errors.name }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Email</label>
                    <input type="email" class="form-control" placeholder="Email" v-model="form.email" id="email" />
                    <div v-if="errors.email">{{ errors.email }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Password</label>
                    <input type="password" class="form-control" placeholder="Create password" v-model="form.password" id="password" />
                    <div v-if="errors.password">{{ errors.password }}</div>
                </div> 

                <button type="submit" class="btn-primary">Signup</button>
            </form>

            <p class="login-text">
                Already have an account?
                <Link href="/login_page">Login</Link>
            </p>
        </div>
    </div>
</template>

<script setup> 
import { Link, useForm } from '@inertiajs/vue3'
import { Github, Twitter } from 'lucide-vue-next';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';



defineProps({ errors: Object })

defineOptions({
    layout: DashboardLayout
})

const form = useForm({
    name: '',
    email: '',
    password: '', 
})

function handleSignup() {
    form.post('/register_page', {
        onSuccess: () => {
            // Handle success (e.g., show a success message or redirect)
            window.location.href = '/login_page';
        },
        onError: () => {
            // Handle error (e.g., show error messages)
            // return Backpack('register_page', {
            //     type: 'error',
            //     message: 'Registration failed. Please check the form for errors.'
            // });
        }
    })
}
</script>

<style scoped>
.signup-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f4f6fb;
}

.signup-card {
    width: 360px;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #ddd;
    outline: none;
}

.password-field {
    position: relative;
}

.eye {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    background: #0d6efd;
    border: none;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}

.login-text {
    text-align: center;
    margin: 12px 0;
}

.login-text a {
    color: #0d6efd;
    text-decoration: none;
}

.divider {
    text-align: center;
    margin: 15px 0;
    color: #999;
}

.btn-facebook {
    width: 100%;
    padding: 10px;
    background: #4267b2;
    color: #fff;
    border: none;
    border-radius: 6px;
    margin-bottom: 10px;
}

.btn-google {
    width: 100%;
    padding: 10px;
    background: #fff;
    color: #444;
    border: 1px solid #ddd;
    border-radius: 6px;
}
</style>