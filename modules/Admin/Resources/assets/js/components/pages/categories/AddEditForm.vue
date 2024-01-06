<template>
<q-form @submit="save(createForm)" @reset="reset" class="q-gutter-md">
    <div class="row">
        <div class="col-6 q-pr-lg">
            <q-card class="my-card">
                <q-card-section>
                    <AppTree :data="tree" :key="(updateTree as boolean)" v-model="(createForm.parent_id as number)" :checkbox-all="true" />
                </q-card-section>
            </q-card>
        </div>
        <div class="col-6">
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

                        <q-input
                            filled
                            v-model="createForm.order"
                            type="number"
                            label="Order *"
                            :rules="[
                            (val) => (val && val > 0) || 'Please type something',
                            ]"
                        />

                        <q-separator class="q-my-md" />
                        <q-input
                            filled
                            v-model="createForm.meta_keywords"
                            label="Meta keywords"
                            class="q-mb-md"
                        />
                        <q-input
                            type="textarea"
                            filled
                            v-model="createForm.meta_description"
                            label="Meta description"
                        />

                        <q-separator class="q-my-md" />
                        <q-toggle v-model="createForm.is_active" label="Active?" />
                </q-card-section>
            </q-card>
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
import { onMounted, ref, Ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import useCategories from '../../../composables/categories';
import { ICategory } from '../../../contracts/pages/ICategory';
import notify from '../../../helpers/notify';
import AppTree from './AppTree.vue';
import { ICategoryTree } from '../../../contracts/pages/IBanners';

const router = useRouter();
const {save, reset, form, getTree, isEdit, getOne, id} = useCategories();
const updateTree: Ref<boolean> = ref(false);

let tree: ICategoryTree[] = [];

getTree()
.then(res => {
    if (res.success) {
        tree = res.data;
        updateTree.value = true
    } else {
        notify.error('Error on getting category tree');
    }
});

const createForm: Ref<ICategory> = form;

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
