import { Ref, UnwrapNestedRefs, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { ICategory } from "../contracts/pages/ICategory";
import { IPaginationParams } from "../contracts/IApiData";
import CategoryService from '../services/api/category-service';
import notify from "../helpers/notify";
import tableColumn from "../contracts/ITableColumn";

export default function useCategories() {
    const router = useRouter();
    const route = useRoute();

    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let form: Ref<ICategory> = ref({
        id: null,
        name: null,
        parent_id: null,
        lft: null,
        rgt: null,
        is_active: true,
        position: null,
        meta_description: null,
        meta_keywords: null,
        order: null
    });
    const formCopy: Ref<ICategory> = form;

    const list: Ref<ICategory[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Category name',
            align: 'left',
            field: row => row.name
        },
        {
            name: 'is_active',
            required: true,
            label: 'Category status',
            align: 'center',
            field: 'is_active'
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
        return CategoryService.pagination(paginationData)
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
        return CategoryService.get(id)
        .then(res => res.data);
    }

    const save = (form: ICategory) => {
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
        return isEdit.value ? CategoryService.update(formData, id.value as number) : CategoryService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return CategoryService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Kategoriya o'chirildi!");
            } else {
                notify.error("Kategoriyani o'chirishda xatolik")
            }
        });
    }

    const getTree = () => {
        return CategoryService.getTree();
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
        getTree,
        // ==========
        form,
        id,
        isEdit,
        columns,
        list
    }
}
