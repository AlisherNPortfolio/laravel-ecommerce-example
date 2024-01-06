<template>
    <div class="row q-mb-md">
        <div class="col-md-11 col-sm-12">
            <q-input
                filled
                v-model="props.data.value"
                label="Value *"
                lazy-rules
                :rules="[
                (val) => (val && val.length > 0) || 'Please type something',
                ]"
                class="q-mr-sm"
            />
        </div>
        <div class="col-md-1 col-sm-12">
            <q-btn icon="delete" @click="removeValue"></q-btn>
        </div>
    </div>
</template>
<script setup lang="ts">
import { PropType } from 'vue';
import { IAttributeValue } from '../../../contracts/pages/IAttribute';
    
    const props = defineProps({
        data: {
            type: Object as PropType<IAttributeValue>,
            default: () => {},
            required: false
        },
        index: {
            type: Number,
            required: true
        }
    });

    const emit = defineEmits(['remove'])

    function removeValue()
    {
        emit('remove', props.index);
    }
</script>
    