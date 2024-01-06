import { Ref, UnwrapNestedRefs, reactive, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { Banner, BannerItem } from '../../contracts/pages/IBanners';
import FormHelper from '../../helpers/form-helper';
import BannerService from '../../services/api/banner-service';
import notify from '../../helpers/notify';
import { IPaginationParams } from '../../contracts/IApiData';
import tableColumn from '../../contracts/ITableColumn';

let form: Ref<Banner> = ref({
    name: null,
    slug: null,
    is_active: true,
    banners: []
});

export default function useBanners() {
    let itemForm: Ref<BannerItem> = ref({
        banner_id: null,
        title: null,
        short_description: null,
        description: null,
        button: null,
        link: null,
        image: null,
        is_active: true,
        meta_keywords: null,
        meta_description:  null
    });
    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);
    const banner: Ref<Banner| object> = ref({})
    const route = useRoute();
    const router = useRouter();

    const formCopy: Ref<Banner> = form;
    const itemCopy: Ref<BannerItem> = itemForm;

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Banner name',
            align: 'left',
            field: row => row.name
        },
        {
            name: 'is_active',
            required: true,
            label: 'Banner status',
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
    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});
    let banners: Ref<Banner[]|[]> = ref([]);
    const bannersCount: Ref<number> = ref(0);

    const getBanners = () => {
        return BannerService.pagination(paginationData).then(res => {
            bannersCount.value = res.data.count;
            banners.value = res.data.data;
        });
    }

    const getBanner = (id: number) => {
        return BannerService.get(id)
        .then(res => res.data);
    }

    // -------------- Write -------------------
    const imageUpload = (files: File[], index: number = 0) => {
        if (form.value.banners?.length) {
            form.value.banners[index].image = files[0];
        }
    }

    const save = (form: Banner) => {
        const formData = new FormData();

        for (let i in form) {
            if (Array.isArray(form[i])) {
                form[i].forEach((item, key) => {
                    for (let j in item) {
                        let itemKey = item[j] instanceof File ? `banners[${key}][${j}]` : `banners[${key}][${j}]${j}`;
                        formData.append(itemKey, item[j]);
                    }
                })
            } else {
                formData.append(i, form[i]);
            }
        }
        // const formData = new FormHelper(form);
        // const data = formData.getForm();

        addOrEdit(formData)
        .then(res => {
            if (res.success) {
                notify.success('Banner saved');
                reset();
                router.push({name: 'banners'});
            }
        })
    }

    const addOrEdit = (formData) => {
        return isEdit.value ? BannerService.update(formData, id.value as number) : BannerService.add(formData);
    }

    const reset = () => {
        form = formCopy;
    }

    const removeItem = (id: number | string | null) => {
        return BannerService.removeItem(id as number)
                .then(res => {
                    if (res.success) {
                        notify.success("Banner o'chirildi!");
                    } else {
                        notify.error("Bannerni o'chirishda xatolik")
                    }
                });
    }

    const deleteRow = (e: number) => {
        return BannerService.remove(e)
        .then(res => {
            if (res.success) {
                notify.success('Banner removed!');
                getBanners();
                reset();
            }
        });
    }

    // ---- private methods
    function defineIsEdit() {
        const innerId = route.params?.id;
        if (innerId) {
            isEdit.value = true;
            id.value = +innerId;
        }
    }

    defineIsEdit();

    return {
        form,
        itemForm,
        columns,
        paginationData,
        banners,
        bannersCount,
        isEdit,
        id,
        banner,
        //-------methods
        save,
        reset,
        imageUpload,
        removeItem,
        deleteRow,
        getBanners,
        getBanner
    }
}
