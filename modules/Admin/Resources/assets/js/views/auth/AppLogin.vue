<template>
    <form class="auth-form">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" id="username" v-model="form.email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" v-model="form.password">

        <q-btn label="Log In" @click="login" text-color="dark" class="login-btn"></q-btn>
        <div class="social">
          <q-btn class="go q-mt-none transparent-btn" icon="fab fa-google" label="Google"></q-btn>
          <q-btn class="fb q-mt-none transparent-btn" icon="facebook" label="Facebook"></q-btn>
        </div>
        <q-separator class="q-my-md" />
        <div class="row justify-center">
            <q-btn class="go q-mt-none items-center transparent-btn" label="Register" to="/panel/auth/register"></q-btn>
        </div>
    </form>
</template>
<script setup lang="ts">
import useAuth from "../../composables/auth";
const { login, form } = useAuth();
</script>
