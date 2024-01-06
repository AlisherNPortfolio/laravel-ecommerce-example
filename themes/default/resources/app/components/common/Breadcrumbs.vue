<template>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <template v-for="(item, index) in links">
                        <nuxt-link v-if="item?.link" class="breadcrumb-item text-dark" :to="item.link">{{ item.title }}</nuxt-link>
                        <span v-else class="breadcrumb-item active">{{ item.title }}</span>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import type { PropType } from 'vue';
import type IBreadcrumbs from '@/contracts/common/IBreadcrumbs'

const props = defineProps({
    links: {
        type: Object as PropType<IBreadcrumbs[]>,
        required: true
    }
})
</script>
