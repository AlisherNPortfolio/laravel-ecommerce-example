<template>
    <form class="auth-form">
        <h3>Register</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" id="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password">

        <label for="password">Confirm Password</label>
        <input type="password" placeholder="Password" id="password">

        <q-btn label="Register" text-color="dark" class="login-btn"></q-btn>
        <div class="social">
          <q-btn class="go q-mt-none transparent-btn" icon="fab fa-google" label="Google"></q-btn>
          <q-btn class="fb q-mt-none transparent-btn" icon="facebook" label="Facebook"></q-btn>
        </div>
        <q-separator class="q-my-md" />
        <div class="row justify-center">
            <q-btn class="go q-mt-none items-center transparent-btn" label="Log In" to="/panel/auth/login"></q-btn>
        </div>
    </form>
</template>
<script lang="ts">
    import { defineComponent } from "@vue/runtime-core";

    export default defineComponent({
        name: 'AppRegister'
    })
</script>
