<template>
    <div class="login-wrapper">
        <div class="login-card">
            <h2 class="title">Login</h2>

            <form @submit.prevent="handleLogin">
                <div class="mb-3">
                    <label class="form-label">Your Email</label>
                    <input type="email" class="form-control" placeholder="Email" v-model="form.email" id="email" />
                    <div v-if="errors.email">{{ errors.email }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" v-model="form.password" id="password" />
                    <div v-if="errors.password">{{ errors.password }}</div>
                </div>

                <div class="forgot">
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="btn-primary">Login</button>
            </form>

            <p class="signup-text">
                Don’t have an account?
                <Link href="/register_page">Signup</Link>
            </p>

            <div class="divider">Or</div>

            <a href="/auth/github">
                 <button class="btn-facebook">
                <Github /> Login with github
            </button>
            </a>
           <a href="/auth/google">
              <button class="btn-google">
                <Twitter /> Login with Google
            </button>
           </a>
          
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
    email: '',
    password: ''
})

const handleLogin = () => { 
    form.post('/login_page', {
        onSuccess: () => {
            // Handle success (e.g., show a success message or redirect)
            window.location.href = '/'; // Redirect to dashboard on successful login
        },
        onError: () => {
            // Handle error (e.g., show error messages)
            return Backpack('login_page', {
                type: 'error',
                message: 'Login failed. Please check your credentials.'
            });
        }
    })
}
</script>

<style scoped>
.login-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f4f6fb;
}

.login-card {
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

.forgot {
    text-align: right;
    margin-bottom: 12px;
}

.forgot a {
    font-size: 14px;
    color: #0d6efd;
    text-decoration: none;
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

.signup-text {
    text-align: center;
    margin: 12px 0;
}

.signup-text a {
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