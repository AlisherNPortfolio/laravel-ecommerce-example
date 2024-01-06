<template>
    <q-file
        :model-value="inputModelValue"
        :label="props.title"
        @update:model-value="pickFiles($event)"
        outlined
        multiple
        :clearable="false"
        style="width:400px"
        ref="qFile"
        :use-chips="props.type === 'simple'"
        :accept="props.fileTypes"
        v-bind="$attrs"
    >
        <template v-if="props.type === 'gallery'" v-slot:file="{ index, file }"></template>
        <template v-else v-slot:file="{ index, file }">
            <q-chip
                class="full-width q-my-xs"
                square
            >
                <q-avatar>
                    <q-img :src="getImage(file)" />
                </q-avatar>
                <div class="ellipsis relative-position">
                {{ file.name }}
                </div>
                <q-tooltip>
                {{ file.name }}
                </q-tooltip>
            </q-chip>
        </template>

        <template v-slot:after>
            <q-btn
                v-if="uploadingFiles.length > 0 && !eagerEmit"
                :disable="props.uploading"
                color="primary"
                dense
                icon="cloud_upload"
                round
                @click="emitFiles(null)"
                :loading="props.uploading"
            />
        </template>
    </q-file>
    <div class="row q-mt-md q-gutter-md">
        <template v-if="inputImages && inputImages.length > 0">
            <div class="col-2 " v-for="(file, idx) in inputImages" :key="idx">
                <q-card flat bordered class="image-card bg-grey-1">
                    <div class="row items-center no-wrap">
                        <q-img :src="getImage(file)" :ratio="4/3" v-if="defineMediaType(file) == 'image'">
                            <div class="absolute-top bg-transparent right">
                                <q-btn
                                    color="grey-7"
                                    round
                                    flat
                                    icon="close"
                                    class="absolute-top"
                                    @click="removeUploadedImage(idx)"
                                ></q-btn>
                            </div>
                            <div class="absolute-bottom text-subtitle2 text-center">

                            </div>
                            <!-- Ushbu qism rasmga qo'shimcha ma'lumot uchun qo'shilgan edi -->
                            <!-- Hozirgi holat uchun faqat rasmni o'zi yuklanadigan bo'lgani uchun bu qism yopib qo'yildi -->
                            <!-- <div class="absolute-bottom text-subtitle2 text-center">
                                <q-input v-model="emittingFiles[idx].name" label="Image title" :id="`input-text${idx}`"></q-input>
                            </div> -->
                        </q-img>
                        <div v-else-if="defineMediaType(file) == 'video'" class="video-preview">
                            <video :src="getImage(file)" controls>
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute-top bg-transparent right">
                            <q-btn
                                color="grey-7"
                                round
                                flat
                                icon="close"
                                class="absolute-top"
                                @click="removeUploadedImage(idx)"
                            ></q-btn>
                        </div>
                        </div>
                    </div>
                </q-card>
            </div>
        </template>
        <div class="col-2 " v-for="(file, idx) in uploadingFiles" :key="idx">
            <q-card flat bordered class="image-card bg-grey-1">
                <div class="row items-center no-wrap">
                    <q-img :src="getImage(file)" :ratio="4/3" v-if="defineMediaType(file) == 'image'">
                        <div class="absolute-top bg-transparent right">
                            <q-btn
                                color="grey-7"
                                round
                                flat
                                icon="close"
                                class="absolute-top"
                                @click="removeUploadedImage(idx, true)"
                            ></q-btn>
                        </div>
                        <div class="absolute-bottom text-subtitle2 text-center">
                            {{ typeof file == 'string' ? 'srv' : file.size / 1024 }}
                        </div>
                        <!-- Ushbu qism rasmga qo'shimcha ma'lumot uchun qo'shilgan edi -->
                        <!-- Hozirgi holat uchun faqat rasmni o'zi yuklanadigan bo'lgani uchun bu qism yopib qo'yildi -->
                        <!-- <div class="absolute-bottom text-subtitle2 text-center">
                            <q-input v-model="emittingFiles[idx].name" label="Image title" :id="`input-text${idx}`"></q-input>
                        </div> -->
                    </q-img>
                    <div v-else-if="defineMediaType(file) == 'video'" class="video-preview">
                        <video :src="getImage(file)" controls>
                            Your browser does not support the video tag.
                        </video>
                        <div class="absolute-top bg-transparent right">
                            <q-btn
                                color="grey-7"
                                round
                                flat
                                icon="close"
                                class="absolute-top"
                                @click="removeUploadedImage(idx, true)"
                            ></q-btn>
                        </div>
                    </div>
                </div>
            </q-card>
        </div>
    </div>
</template>
<script setup lang="ts">
import { ref, Ref } from 'vue';
import notify from '../helpers/notify';
const imageTypes: string[] = ['png', 'jpg', 'jpeg', 'bmp', 'webp', 'svg', 'gif'];
const videoTypes: string[] = ['mp4'];
const props = defineProps({
    modelValue: {
        type: Array,
        default: () => []
    },
    title: {
        type: String,
        default: 'Choose file'
    },
    fileTypes: {
        type: String,
        default: "image/jpg,image/jpeg,image/png,image/webp"
    },
    type: {
        type: String,
        default: 'gallery'
    },
    uploading: {
        type: Boolean,
        default: false
    },
    maxFiles: {
        type: Number,
        default: 10
    },
    eagerEmit: {
         type: Boolean,
         default: true
    },
    images: {
        type: Array,
        default: () => []
    },
    urlPrefix: {
        type: String,
        default: '/storage/'
    },
});


const emit = defineEmits(['update:modelValue', 'upload']);

const uploadingFiles: Ref<File[]|string[]> = ref([]);

const inputModelValue: Ref<any[]> = ref([]);

const inputImages: Ref<any[]> = ref([]);

function emitFiles(files: any, isFromServer: boolean = false) {
    if (!isFromServer && !validate()) {
        notify.error('Error on validation!');
        return;
    }

    const endFiles: any = files ? files : uploadingFiles.value;

   emit('update:modelValue', endFiles);
   emit('upload', endFiles);
}

function getImage(file: any): string {
    if (!file) return "";
    return typeof file == 'string' ?
            `${props.urlPrefix}${file}` :
            (file?.image ? `${props.urlPrefix}${file.image}` : URL.createObjectURL(file));
}

function pickFiles(files: any) {

    if (checkFileCount(files)) {
        notify.error(`Uploading images quantity should not be exceeded more then ${props.maxFiles}`);
        return;
    }

    if (Array.isArray(files)) {
        files.forEach((file: any) => {
            insertFile(file);
        });
    } else {
        insertFile(files);
    }

    if (props.eagerEmit) {
        emitFiles(files);
    }
}

function insertFile(file: any) {
    if (uploadingFiles.value.findIndex(image => image.name === file.name) < 0) {
        uploadingFiles.value.push(file);

        if (!props.eagerEmit) notify.success('The media has been added to the queue!');
    } else {
        if (!props.eagerEmit) notify.error('The media with this name exists!')
    }
}

function removeUploadedImage(index: number, isUploading: boolean = false): void {
    if (isUploading) {
        uploadingFiles.value.splice(index, 1);
    } else {
        const removedMedia: string[] = inputImages.value.splice(index, 1);
        emitFiles(removedMedia[0])
    }
    if (!props.eagerEmit) notify.success('The media removed!');
}

function validate() {
    let validations = {};
    // emittingFiles.value.forEach((val: IUploadingFile, index: number) => {
    //     // TODO: validationni davom ettirish
    // })
    return true;
}

function checkFileCount(files: any): boolean {
    const filesCount: number = files.length;
    const filesCountCheck: boolean = Array.isArray(files) && filesCount > +props.maxFiles;
    const uploadedFilesCount: number = uploadingFiles.value.length;

    return uploadedFilesCount > +props.maxFiles ||
            filesCountCheck ||
            (filesCount + uploadedFilesCount) > +props.maxFiles;
}

function clearInput(data: any[]): any[] {
    return data.filter(image => {
            return image && image != '';
        });
}

function onCreated(): void {
    if (inputModelValue.value.length > 0) {
        uploadingFiles.value = inputModelValue.value as File[]|string[];
    }

    inputImages.value =clearInput(props.images);
    inputModelValue.value = clearInput(props.modelValue)
}

function defineMediaType(file: File|string): string|null {
    if (file instanceof File) {
        return file.type.split('/')[0];
    }

    let mediaExtension: string = file.split('.').pop();

    return imageTypes.includes(mediaExtension) ? 'image' : (videoTypes.includes(mediaExtension) ? 'video' : null);
}

onCreated();
</script>
<style scoped lang="scss">
.images-preview {
    width: 100%;
}
.video-preview,
video {
    height: 60px;
    width: 100%;
}
video {
    display: block;
    margin: 0 auto;
}
</style>
