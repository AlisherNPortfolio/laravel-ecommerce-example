import { Ref, UnwrapNestedRefs, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { IPaginationParams } from "../contracts/IApiData";
import AttributeService from '../services/api/attribute-service';
import notify from "../helpers/notify";
import tableColumn from "../contracts/ITableColumn";
import { IAttribute, IAttributeValue } from "../contracts/pages/IAttribute";

export default function useAttribute() {
    const router = useRouter();
    const route = useRoute();

    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let form: Ref<IAttribute> = ref({
        id: null,
        name: null,
        values: []
    });
    let itemForm: Ref<IAttributeValue> = ref({
        value: null
    });
    const formCopy: Ref<IAttribute> = form;
    const itemCopy: Ref<IAttributeValue> = itemForm;

    const list: Ref<IAttribute[]> = ref([]);
    const allAttributes: Ref<IAttribute[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Attribute name',
            align: 'left',
            field: row => row.name
        },
        {
            name: 'values',
            required: true,
            label: 'Attribute values',
            align: 'left',
            field: row => row.values
        },
        {
            name: 'actions',
            required: true,
            label: 'Actions',
            align: 'center',
            field: ''
        }
    ];

    // ================ Methods ==============

    const getList = () => {
        return AttributeService.pagination(paginationData)
        .then(res => {
            if (res.success) {
                list.value = res.data.data;
                totalCount.value = res.data.count;
            } else {
                notify.error('Kategoriyalarni olishda xatolik')
            }
        });
    }

    const getOne = (id: number) => {
        return AttributeService.get(id)
        .then(res => res.data);
    }

    const save = (form: IAttribute) => {

        addOrEdit(form)
        .then(res => {
            if (res.success) {
                notify.success('Shipping method saved');
                reset();
                router.push({name: 'attributes'});
            }
        })
    }

    const addOrEdit = (formData: IAttribute) => {
        return isEdit.value ? AttributeService.update(formData, id.value as number) : AttributeService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return AttributeService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Shipping method removed!");
            } else {
                notify.error("Error on removing shipping method")
            }
        });
    }

    const getAllAttributes = () => {
        return AttributeService.all()
        .then(res => {
            if (res.success) {
                allAttributes.value = res.data;
            } else {
                notify.error('Error on getting attributes list');
            }
        })
    }

    const attributeOptions = ref([...allAttributes.value]);
    function filterAttributes(val, update) {
        if (!val) {
            update(() => {
                attributeOptions.value = allAttributes.value
            })
            return
        }

        update(() => {
            const needle = val.toLowerCase()
            attributeOptions.value = allAttributes.value.filter(v => (v.name as string).toLowerCase().indexOf(needle) > -1)
        })
    }

    function displaySelectedAttributes(id) {
        /* @ts-ignore */
        const shipping = allAttributes.value.find(b => b.id == id);
        return shipping ? shipping.name : 'None'
    }

    const reset = () => {
        form = formCopy;
    }

    function defineIsEdit() {
        const innerId = route.params?.id;
        if (innerId) {
            isEdit.value = true;
            id.value = +innerId;
        }
    }

    defineIsEdit();

    return {
        getList,
        getOne,
        save,
        remove,
        reset,
        getAllAttributes,
        filterAttributes,
        displaySelectedAttributes,
        // ==========
        form,
        itemForm,
        id,
        isEdit,
        columns,
        list,
        allAttributes,
        attributeOptions
    }
}
