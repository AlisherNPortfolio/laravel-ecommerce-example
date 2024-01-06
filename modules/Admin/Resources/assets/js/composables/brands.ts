import { Ref, UnwrapNestedRefs, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { IPaginationParams } from "../contracts/IApiData";
import tableColumn from "../contracts/ITableColumn";
import notify from "../helpers/notify";
import { IBrand } from "../contracts/pages/IBrands";
import BrandService from '../services/api/brand-service';

export default function useBrands() {
    const router = useRouter();
    const route = useRoute();

    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let form: UnwrapNestedRefs<IBrand> = reactive({
        id: null,
        name: null,
        slug: null,
        description: null
    });
    const formCopy: UnwrapNestedRefs<IBrand> = form;

    const list: Ref<IBrand[]> = ref([]);
    const allList: Ref<IBrand[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Brand name',
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
        return BrandService.pagination(paginationData)
        .then(res => {
            if (res.success) {
                list.value = res.data.data;
                totalCount.value = res.data.count;
            } else {
                notify.error('Error on getting products')
            }
        });
    }

    const getOne = (id: number) => {
        return BrandService.get(id)
        .then(res => res.data);
    }

    const save = (form: IBrand) => {
        const formData: FormData = new FormData();
        for (let i in form) {
            if (form[i]) {
                formData.append(i, form[i]);
            }
        }

        addOrEdit(formData)
        .then(res => {
            if (res.success) {
                notify.success('Category saved');
                reset();
                router.push({name: 'categories'});
            }
        })
    }

    const addOrEdit = (formData: FormData) => {
        return isEdit.value ? BrandService.update(formData, id.value as number) : BrandService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return BrandService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Brand removed!");
            } else {
                notify.error("Error on removing brand!")
            }
        });
    }

    const getAll = () => {
        return BrandService.all()
        .then(res => {
            if (res.success) {
                allList.value = res.data;
            } else {
                notify.error('Error on getting brands list');
            }
        })
    }

    const reset = () => {
        form = formCopy;
    }

    const options = ref([...allList.value]);
    function filterBrands(val, update) {
        if (!val) {
            update(() => {
                options.value = allList.value
            })
            return
        }

        update(() => {
            const needle = val.toLowerCase()
            options.value = allList.value.filter(v => (v.name as string).toLowerCase().indexOf(needle) > -1)
        })
    }

    function displaySelectedBrand(id) {
        const brand = allList.value.find(b => b.id == id);
        return brand ? brand.name : 'None'
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
        getAll,
        filterBrands,
        displaySelectedBrand,
        // ==========
        form,
        id,
        isEdit,
        columns,
        list,
        allList,
        options
    }
}
