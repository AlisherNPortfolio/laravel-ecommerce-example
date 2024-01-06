<template>
    <q-form @submit="emit('save', payment);" class="q-gutter-md">
        <div class="row q-my-lg">
            <div class="col-md-6 col-sm-12">
                <q-input
                    filled
                    v-model="payment.name"
                    label="Name *"
                    lazy-rules
                    :rules="[
                    (val) => (val && val.length > 0) || 'Please type something',
                    ]"
                />
            </div>
            <div class="col-md-6 col-sm-12 q-pl-md">
                <template v-if="payment?.id && payment.image">
                    <img :src="settings.IMG_BASE_URL + (payment.image as string)" width="100"/>
                </template>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 q-pl-md">
                <input type="file" @change="addImage($event)" accept="image/*" class="q-my-md" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <q-btn
                    color="orange"
                    label="Add setting"
                    icon="add"
                    outline
                    size="sm"
                    @click="addSetting(payment)"
                    class="q-mb-sm"
                />
            </div>
        </div>
        <div class="row" v-for="(setting, indexy) in payment.settings" :key="indexy">
            <div class="col-sm-12 col-md-2">
                <q-input
                    v-if="!setting?.id"
                    filled
                    v-model="setting.key"
                    label="Key *"
                    lazy-rules
                    :rules="[
                    (val) => (val && val.length > 0) || 'Please type something',
                    ]"
                />
                <span v-else>{{ setting.key }}</span>
            </div>
            <div class="col-sm-12 col-md-7 q-pl-md">

                <template v-if="setting.field_type == PaymentSettingFieldType.FIELD_TYPE_INPUT || setting.field_type == PaymentSettingFieldType.FIELD_TYPE_TEXT">
                    <q-input
                        filled
                        :type="setting.field_type"
                        v-model="setting.value"
                        label="Value *"
                        lazy-rules
                        :rules="[
                        (val) => (val && val.length > 0) || 'Please type something',
                        ]"
                    />
                </template>
                <template v-else-if="setting.field_type == PaymentSettingFieldType.FIELD_TYPE_CHECKBOX">
                    <q-toggle v-model="setting.value" />
                </template>
            </div>
            <div class="col-sm-12 col-md-2 q-pl-md">
                <q-select v-if="!setting?.id" v-model="setting.field_type" :options="settingsTypeList" label="Field type"></q-select>
            </div>
            <div class="col-sm-12 col-md-1 q-pl-md" v-if="!setting?.id">
                <q-btn
                    color="orange"
                    label=""
                    icon="delete"
                    outline
                    size="sm"
                    @click="removeSetting(setting)"
                    class="q-mb-sm"
                />
            </div>
        </div>
        <div class="col-12">
            <q-btn label="Submit" type="submit" color="primary" />
        </div>
    </q-form>
</template>
<script setup lang="ts">
import { PropType, Ref, ref } from 'vue';
import { IPaymentType, IPaymentTypeSetting } from '../../../contracts/pages/IPaymentType';
import { PaymentSettingFieldType } from '../../../types/enum';
import usePaymentType from '../../../composables/payment-type';
import settings from '../../../settings';
let { settingTypeList, save } = usePaymentType();

const settingsTypeList: string[] = settingTypeList();

const props = defineProps({
    payment: {
        type: Object as PropType<IPaymentType>,
        required: true
    }
});

const emit = defineEmits(['save'])

function addImage(e: Event) {
    const target = e.target as HTMLInputElement;
    if (target && target.files) {
        props.payment.image = target.files[0];
    }
}

function addSetting(payment: IPaymentType)
{
    payment.settings.push({
                payment_type_id: null,
                key: null,
                value: null,
                field_type: PaymentSettingFieldType.FIELD_TYPE_INPUT
            });
}

function removeSetting(setting: IPaymentTypeSetting) {
    const settingIndex = props.payment.settings.findIndex(s => s == setting);
    if (settingIndex > -1) {
        props.payment.settings.splice(settingIndex, 1);
    }
}
</script>
