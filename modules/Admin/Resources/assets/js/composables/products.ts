import { Ref, UnwrapNestedRefs, reactive, ref, toRaw } from "vue";
import { useRoute, useRouter } from "vue-router";
import { IPaginationParams } from "../contracts/IApiData";
import tableColumn from "../contracts/ITableColumn";
import notify from "../helpers/notify";
import productService from "../services/api/product-service";
import { IProduct, IProductMedia } from "../contracts/pages/IProduct";
import useHelpers from "./common/helpers";
// TODO: store all retrieved data into store;
export default function useProducts() {
    const router = useRouter();
    const route = useRoute();
    const {cloneReactiveObj} = useHelpers();

    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let {form, formCopy} = cloneReactiveObj<IProduct>({
            id: null,
            name: null,
            slug: null,
            sku: null,
            price: null,
            discounted_price: null,
            cost: null,
            quantity: null,
            sell_out_of_stock: false,
            description: "",
            category_id: null,
            brand_id: null,
            is_active: true,
            meta_keywords: null,
            meta_description: null,
            measure_type: null,
            images: [],
            videos: [],
            preview: "",
            is_featured: false,
            is_new: false,
            is_popular: false,
            has_warranty: false,
            warranty_period: null,
            tax_rule_id: null,
            shipping_id: null,
            attribute_values: []
    });

    const list: Ref<IProduct[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Name',
            align: 'left',
            field: row => row.name
        },
        {
            name: 'is_active',
            required: true,
            label: 'Status',
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
        return productService.pagination(paginationData)
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
        return productService.get(id)
        .then(res => res.data);
    }

    function save(form: UnwrapNestedRefs<IProduct>) {
        const formData = new FormData();
console.log('form', form);
        for (let i in form) {
            if (Array.isArray(form[i])) {
                form[i].forEach((item, key) => {
                    const itemKey: string = i == 'images' ? `images[${key}]` : `videos[${key}]`
                    formData.append(itemKey, item);
                })
            } else {
                formData.append(i, form[i]??'');
            }
        }

        addOrEdit(formData)
        .then(res => {
            if (res.success) {
                notify.success('Product saved');
                reset();
                router.push({name: 'products'});
            } else {
                notify.error('Error on saving product');
            }
        })
    }

    const addOrEdit = (formData: FormData) => {
        return isEdit.value ? productService.update(formData, id.value as number) : productService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return productService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Product removed!");
                getList();
            } else {
                notify.error("Error on removing product!")
            }
        });
    }

    const reset = () => {
        form = formCopy;
    }

    const uploadMedia = (images: IProductMedia) => {
        const formData = new FormData();
        for (let i in images.media) {
            formData.append(`images[${i}]`, images.media[i]);
        }

        formData.append('path', images.path);

        return productService.uploadImages(formData)
    }

    const deleteMedia = (images: string[]) => {
        return productService.deleteImages(images);
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
        uploadMedia,
        deleteMedia,
        // ==========
        form,
        id,
        isEdit,
        columns,
        list,
        formCopy
    }
}
