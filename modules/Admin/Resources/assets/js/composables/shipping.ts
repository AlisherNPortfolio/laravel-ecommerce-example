import { Ref, UnwrapNestedRefs, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { ICategory } from "../contracts/pages/ICategory";
import { IPaginationParams } from "../contracts/IApiData";
import ShippingService from '../services/api/shipping-service';
import notify from "../helpers/notify";
import tableColumn from "../contracts/ITableColumn";
import { IShipping } from "../contracts/pages/IShipping";

export default function useShipping() {
    const router = useRouter();
    const route = useRoute();

    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let form: Ref<IShipping> = ref({
        id: null,
        name: null,
        rules: []
    });
    const formCopy: Ref<IShipping> = form;

    const list: Ref<IShipping[]> = ref([]);
    const allShippings: Ref<IShipping[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Shipping name',
            align: 'left',
            field: row => row.name
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
        return ShippingService.pagination(paginationData)
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
        return ShippingService.get(id)
        .then(res => res.data);
    }

    const save = (form: IShipping) => {

        addOrEdit(form)
        .then(res => {
            if (res.success) {
                notify.success('Shipping method saved');
                reset();
                router.push({name: 'shippings'});
            }
        })
    }

    const addOrEdit = (formData: IShipping) => {
        return isEdit.value ? ShippingService.update(formData, id.value as number) : ShippingService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return ShippingService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Shipping method removed!");
            } else {
                notify.error("Error on removing shipping method")
            }
        });
    }

    const getAllShippings = () => {
        return ShippingService.all()
        .then(res => {
            if (res.success) {
                allShippings.value = res.data;
            } else {
                notify.error('Error on getting shipping list');
            }
        })
    }

    const shippingOptions = ref([...allShippings.value]);
    function filterShippings(val, update) {
        if (!val) {
            update(() => {
                shippingOptions.value = allShippings.value
            })
            return
        }

        update(() => {
            const needle = val.toLowerCase()
            shippingOptions.value = allShippings.value.filter(v => (v.name as string).toLowerCase().indexOf(needle) > -1)
        })
    }

    function displaySelectedShipping(id) {
        const shipping = allShippings.value.find(b => b.id == id);
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
        getAllShippings,
        filterShippings,
        displaySelectedShipping,
        // ==========
        form,
        id,
        isEdit,
        columns,
        list,
        allShippings,
        shippingOptions
    }
}
