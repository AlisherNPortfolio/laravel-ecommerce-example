import { Ref, UnwrapNestedRefs, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { IPaginationParams } from "../contracts/IApiData";
import PaymentTypeService from '../services/api/payment-type-service';
import notify from "../helpers/notify";
import { IPaymentType } from "../contracts/pages/IPaymentType";
import { PaymentSettingFieldType } from "../types/enum";

export default function usePaymentType() {
    const router = useRouter();

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let form: Ref<IPaymentType> = ref({
        id: null,
        name: null,
        image: null,
        is_active: true,
        settings: []
    });

    const formCopy: Ref<IPaymentType> = form;

    const list: Ref<IPaymentType[]> = ref([]);
    const allPaymentTypes: Ref<IPaymentType[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    // ================ Methods ==============

    const getList = () => {
        return PaymentTypeService.pagination(paginationData)
        .then(res => {
            if (res.success) {
                list.value = res.data.data;
                totalCount.value = res.data.count;
            } else {
                notify.error('Error on getting payment types')
            }
        });
    }

    const getOne = (id: number) => {
        return PaymentTypeService.get(id)
        .then(res => res.data);
    }

    const save = (form: IPaymentType) => {
        const formData = new FormData();

        for (let i in form) {
            if (i == 'settings') {
                form[i].forEach((s, i) => {
                    for (let k in s) {
                        if (s[k]) {
                            formData.append(`settings[${i}][${k}]`, s[k])
                        }
                    }
                })
            } else {
                formData.append(i, form[i]??'');
            }
        }

        addOrEdit(formData, form?.id)
        .then(res => {
            if (res.success) {
                notify.success('Payment Type saved');
                getList();
                reset();
                router.push({name: 'payment-types'});
            }
        })
    }

    const addOrEdit = (formData: FormData, id: number|null) => {console.log('id', id)
        return !!id ? PaymentTypeService.update(formData, id as number) : PaymentTypeService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return PaymentTypeService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Payment type removed!");
                getList();
            } else {
                notify.error("Error on removing payment type")
            }
        });
    }

    const getAllPaymentTypes = () => {
        return PaymentTypeService.all()
        .then(res => {
            if (res.success) {
                allPaymentTypes.value = res.data;
            } else {
                notify.error('Error on getting payment type list');
            }
        })
    }

    const paymentTypeOptions = ref([...allPaymentTypes.value]);
    function filterTaxRules(val, update) {
        if (!val) {
            update(() => {
                paymentTypeOptions.value = allPaymentTypes.value
            })
            return
        }

        update(() => {
            const needle = val.toLowerCase()
            paymentTypeOptions.value = allPaymentTypes.value.filter(v => (v.name as string).toLowerCase().indexOf(needle) > -1)
        })
    }

    function displaySelectedPaymentType(id) {
        const paymentType = allPaymentTypes.value.find(b => b.id == id);
        return paymentType ? paymentType.name : 'None'
    }

    const reset = () => {
        form = formCopy;
    }

    function settingTypeList(): string[] {
        const settingsList: string[] = [];
        for (let type in PaymentSettingFieldType) {
            settingsList.push(PaymentSettingFieldType[type])
        }

        return settingsList;
    }

    return {
        getList,
        getOne,
        save,
        remove,
        reset,
        getAllPaymentTypes,
        displaySelectedPaymentType,
        filterTaxRules,
        settingTypeList,
        // ==========
        form,
        list,
        allPaymentTypes,
        paymentTypeOptions
    }
}
