<template>
    <h1>Page not found</h1>
    <router-link to="/panel">Go home</router-link>
</template>
<script lang="ts">
import {defineComponent} from '@vue/runtime-core';

export default defineComponent({
    name: 'NotFoundPage'
})
</script>
