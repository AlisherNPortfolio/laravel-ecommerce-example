<template>
    <media-uploader
        @upload="mediaUpload($event)"
        :images="(images as any[])"
        :max-files="20"
        style="width:100%;"
        class="q-mt-md"
        title="Upload images"
    />
    <media-uploader
        @upload="mediaUpload($event, 'videos')"
        :images="(videos as any[])"
        :max-files="20"
        style="width:100%;"
        class="q-mt-md"
        title="Upload video"
        file-types="video/mp4"
    />
</template>
<script setup lang="ts">
import MediaUploader from "../../MediaUploader.vue";
import { PropType, UnwrapNestedRefs, computed } from "vue";
import { IProduct } from "../../../contracts/pages/IProduct";
import IUploadingImage from "../../../contracts/IUploadingImage";

const props = defineProps({
    form: {
        type: Object as PropType<UnwrapNestedRefs<IProduct>>,
        required: true
    }
});

const mediaUpload = (files: File[]|string, fieldName: string = 'images') => {
    const formFiles = (props.form[`${fieldName}`] as (string|File)[]);
    if (typeof files == 'string') {
        const mediaIndex: number = formFiles.findIndex(media => media == files as string);
        if (mediaIndex > -1) (props.form[`${fieldName}`] as (File|string)[]).splice(mediaIndex, 1);

        return;
    }

    if (formFiles.length == 0) {
        (props.form[`${fieldName}`] as (File|string)[]) = files as File[];
    } else {
        (props.form[`${fieldName}`] as (File|string)[]) = [...formFiles, ...files as File[]];
    }
}

const images = computed((): string[] => {
    return props.form.images as string[];
})

const videos = computed((): string[] => {
    return props.form.videos as string[];
});
</script>
