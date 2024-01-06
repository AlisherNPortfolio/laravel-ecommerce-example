<template>
<div class="q-px-md text-grey-9" :class="{'q-py-md': secondType}">
    <div class="row items-center q-gutter-x-sm q-gutter-y-xs">
    <a
        v-for="menu in menuList"
        :key="menu.text"
        class="YL__drawer-footer-link"
        :href="menu.link"
    >
        {{ menu.text }}
    </a>
    </div>
</div>
</template>
<script setup lang="ts">
import { LittleMenu } from '../../contracts/IMenu';

const props = withDefaults(defineProps<{
  menuList: LittleMenu[],
  secondType?: boolean
}>(), {
    secondType: false
});
</script>
