<template>
    <div>
        <q-input
            filled
            v-model="form.name"
            label="Name *"
            lazy-rules
            :rules="[
            (val) => (val && val.length > 0) || 'Please type something',
            ]"
            class="q-my-md"
        />
        <label for="form_preview" class="row color-grey-10 q-mb-sm q-ml-sm item-start no-wrap">Preview</label>
        <rich-editor id="form_preview" v-model="form.preview" class="q-mb-md" min-height="5rem"/>
        <label for="form_description" class="row color-grey-10 q-mb-sm q-ml-sm item-start no-wrap">Description</label>
        <rich-editor id="form_description" v-model="form.description" class="q-mb-md" />
    </div>
</template>
<script setup lang="ts">
import { PropType, UnwrapNestedRefs, reactive } from 'vue';
import { IProduct } from '../../../contracts/pages/IProduct';
import RichEditor from '../../RichEditor.vue';

const props = defineProps({
    form: {
        type: Object as PropType<UnwrapNestedRefs<IProduct>>,
        required: true
    }
});

const form: UnwrapNestedRefs<IProduct> = reactive(props.form);
</script>
