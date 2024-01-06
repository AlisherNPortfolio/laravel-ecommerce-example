<template>
    <q-form @submit="save(createForm)" @reset="reset" class="q-gutter-md">
    <div class="row">
        <div class="col-4 q-pr-lg">
            <q-card class="my-card">
                <q-card-section>
                        <q-input
                            filled
                            v-model="createForm.name"
                            label="Name *"
                            lazy-rules
                            :rules="[
                            (val) => (val && val.length > 0) || 'Please type something',
                            ]"
                        />
                </q-card-section>
            </q-card>
        </div>
        <div class="col-6">
            <q-card class="my-card">
                <q-card-section>
                    <span v-if="createForm.values?.length == 0">There is no any item!</span>
                    <template v-else>
                        <AttributeValue v-for="(item, index) in createForm.values" :data="item" :index="index" @remove="removeValue" :key="index" />
                    </template>
                </q-card-section>
            </q-card>
        </div>
        <div class="col-2">
            <q-btn
                label="Add"
                icon="add"
                color="success"
                outline
                class="q-ml-md"
                style="color: goldenrod;"
                @click="addItem"
            ></q-btn>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
                <div>
                    <q-btn label="Submit" type="submit" color="primary" />
                    <q-btn
                    label="Back"
                    type="button"
                    color="primary"
                    flat
                    class="q-ml-sm"
                    @click="router.go(-1)"
                    />
                </div>
            </div>
    </div>
</q-form>
</template>
<script setup lang="ts">
import { Ref, onMounted } from 'vue';
import useAttribute from '../../../composables/attributes';
import AttributeValue from './AttributeValue.vue';
import { useRouter } from 'vue-router';
import { IAttribute } from '../../../contracts/pages/IAttribute';

const router = useRouter();

const emit = defineEmits(['get-form']);
const {
    save,
    reset,
    getOne,
    form,
    itemForm,
    isEdit,
    id
} = useAttribute();

let createForm: Ref<IAttribute> = form;

function addItem() {
    if (!createForm.value.values) {
        createForm.value.values = [];
    }
    createForm.value.values.push({...itemForm.value});
}

function removeValue(index: number) {
    createForm.value.values.splice(index, 1);
}

function init() {
    if (isEdit.value) {
        getOne(id.value as number)
        .then(res => {
            createForm.value = res;
        })
    }
}

onMounted(() => {
    init();
})
</script>
