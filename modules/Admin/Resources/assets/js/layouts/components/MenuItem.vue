<template>
<q-item v-ripple clickable :to="props.item.link">
    <q-item-section avatar class="items-end">
        <q-icon color="grey" :name="props.item.icon" />
    </q-item-section>
    <q-item-section>
        <q-item-label>{{ props.item.text }}</q-item-label>
    </q-item-section>
</q-item>
</template>
<script setup lang="ts">
import { Menu } from '../../contracts/IMenu'

const props = defineProps<{
    item: Menu
}>();
</script>
