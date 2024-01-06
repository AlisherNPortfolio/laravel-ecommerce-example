<template>
    <div>
        <q-input color="teal" filled v-model="form.meta_keywords" label="Meta Keywords" class="q-my-md" />
        <q-input color="teal" filled v-model="form.meta_description" label="Meta Description" type="textarea"/>
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import { IProduct } from '../../../contracts/pages/IProduct';

const props = defineProps({
    form: {
        type: Object as PropType<IProduct>,
        required: true
    }
})
</script>
