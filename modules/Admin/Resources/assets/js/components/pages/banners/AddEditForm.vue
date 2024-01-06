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
                            @keyup="setSlug"
                            :rules="[
                            (val) => (val && val.length > 0) || 'Please type something',
                            ]"
                        />

                        <q-input
                            filled
                            v-model="createForm.slug"
                            label="Slug *"
                            :rules="[
                            (val) => (val && val.length > 0) || 'Slug should be filled automatically',
                            ]"
                        />

                        <q-toggle v-model="createForm.is_active" label="Active?" />
                </q-card-section>
            </q-card>
        </div>
        <div class="col-6">
            <q-card class="my-card">
                <q-card-section>
                    <span v-if="createForm.banners?.length == 0">There is no any item!</span>
                    <template v-else>
                        <BannerItem v-for="(item, index) in createForm.banners" :data="item" :index="index" :key="index" />
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
import { PropType, Ref, onMounted, ref } from 'vue';
import useBanners from '../../../composables/banners/banners';
import { Banner } from '../../../contracts/pages/IBanners';
import useHelpers from '../../../composables/common/helpers';
import BannerItem from './BannerItem.vue';
import { useRouter } from 'vue-router';

const props = defineProps({
    form: {
        type: Object as PropType<Banner>,
        default: () => {}
    }
});

const router = useRouter();

const emit = defineEmits(['get-form']);
const {makeSlug} = useHelpers();
const {
    save,
    reset,
    form,
    itemForm,
    isEdit,
    id,
    banner,
    getBanner
} = useBanners();

let createForm: Ref<Banner> = form;

function setSlug(e) {
    createForm.value.slug = makeSlug(e);
}
function addItem() {
    if (!createForm.value.banners) {
        createForm.value.banners = [];
    }
    createForm.value.banners.push({...itemForm.value});
}

function init() {
    if (isEdit.value) {
        getBanner(id.value as number)
        .then(res => {
            createForm.value = res.data;
        })
    }
}

onMounted(() => {
    init();
})
</script>
