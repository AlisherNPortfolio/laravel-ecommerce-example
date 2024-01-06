<template>
    <q-toggle
        v-model="form.is_active"
        label="Visible on the site?"
        checked-icon="check"
        color="green"
        unchecked-icon="clear" class="q-mt-md"
        size="md"
    />
    <q-separator color="grey-5" class="q-my-md" />
    <q-toggle
        v-model="form.is_featured"
        label="Featured product"
        checked-icon="check"
        color="green"
        unchecked-icon="clear" class="q-mt-md"
        size="md"
    />
    <q-toggle
        v-model="form.is_new"
        label="New product"
        checked-icon="check"
        color="green"
        unchecked-icon="clear" class="q-mt-md"
        size="md"
    />

    <q-toggle
        v-model="form.is_popular"
        label="Popular product"
        checked-icon="check"
        color="green"
        unchecked-icon="clear" class="q-mt-md"
        size="md"
    />
    <q-separator color="grey-5" class="q-my-md" />
    <q-toggle
        v-model="form.has_warranty"
        label="Has product warranty"
        checked-icon="check"
        color="green"
        unchecked-icon="clear" class="q-my-sm"
        size="md"
    />
    <q-input
            v-if="form.has_warranty"
            filled
            v-model.number="form.warranty_period"
            label="Warranty period *"
            lazy-rules
            :rules="[
            (val) => (form.has_warranty && val && val > 0) || 'Please type something',
            ]"
            class="q-my-md"
            type="number"
            mask="##"
        />

</template>
<script setup lang="ts">
import { PropType, UnwrapNestedRefs, reactive } from "vue";
import { IProduct } from "../../../contracts/pages/IProduct";

const props = defineProps({
    form: {
        type: Object as PropType<UnwrapNestedRefs<IProduct>>,
        required: true
    }
});
const form: UnwrapNestedRefs<IProduct> = reactive(props.form);
</script>
