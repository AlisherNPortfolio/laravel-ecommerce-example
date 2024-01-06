<template>
<q-expansion-item>
        <template v-slot:header>
            <q-item-section avatar>
                <q-avatar icon="tv" color="primary" text-color="white" />
            </q-item-section>

            <q-item-section>
                {{ props.data?.title ?? 'Banner item' }}
            </q-item-section>

            <q-item-section side>
                <div class="row items-center">
                <q-btn icon="delete" outline color="danger" @click="removeItem(props.data?.id as number)"></q-btn>
                </div>
            </q-item-section>
        </template>
        <template v-if="props.data">
            <q-input
                filled
                v-model="props.data.title"
                label="Name *"
                lazy-rules
                :rules="[
                (val) => (val && val.length > 0) || 'Please type something',
                ]"
                class="q-my-md"
            />
            <q-input
                filled
                v-model="props.data.short_description"
                label="Short description"
                lazy-rules
                type="textarea"
                class="q-mb-md"
            />

            <rich-editor v-model="props.data.description" class="q-mb-md" />
            <hr style="border: 1px solid rgb(213, 213, 213); background-color: transparent" class="q-mb-md"/>
            <q-input
                filled
                v-model="props.data.button"
                label="Button text"
                lazy-rules
                class="q-mb-md"
            />
            <q-input
                filled
                v-model="props.data.link"
                label="Button link"
                lazy-rules
                class="q-mb-md"
            />
            <hr style="border: 1px solid rgb(213, 213, 213); background-color: transparent" class="q-mb-md"/>
            <media-uploader @upload="imageUpload($event, props.index)" :images="([props.data.image] as any[])" :max-files="1"/>
            <q-toggle v-model="props.data.is_active" label="Active" />
        </template>
    </q-expansion-item>
</template>
<script setup lang="ts">
import RichEditor from '../../RichEditor.vue';
import MediaUploader from '../../MediaUploader.vue';
import useBanners from '../../../composables/banners/banners';
import { PropType } from 'vue';
import { BannerItem } from '../../../contracts/pages/IBanners';

const props = defineProps({
    data: {
        type: Object as PropType<BannerItem>,
        default: () => {},
        required: false
    },
    index: {
        type: Number,
        required: true
    }
});

const { imageUpload, removeItem } = useBanners();
</script>
