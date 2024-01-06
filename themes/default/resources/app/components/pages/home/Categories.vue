<template>
    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3" v-if="categories.length">
            <category-item v-for="(category, index) in categories" :item="category" :key="index" />
        </div>
    </div>
    <!-- Categories End -->
</template>
<script setup lang="ts">
import type { PropType } from 'vue';
import type { ICategory } from '~/contracts/pages/ICommon';
import CategoryItem from './../categories/CategoryItem.vue';

const props = defineProps({
    list: {
        type: Object as PropType<ICategory[]>,
        required: true
    }
});

const categories = computed(() => {
    return props.list.filter(c => c.position == 1);
})
</script>
