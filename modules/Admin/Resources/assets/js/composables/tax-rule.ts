import { Ref, UnwrapNestedRefs, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { IPaginationParams } from "../contracts/IApiData";
import TaxRuleService from '../services/api/tax-rule-service';
import notify from "../helpers/notify";
import tableColumn from "../contracts/ITableColumn";
import { ITaxRule } from "../contracts/pages/ITaxRule";

export default function useTaxRule() {
    const router = useRouter();
    const route = useRoute();

    let id: Ref<number | null> = ref(null);
    let isEdit: Ref<boolean> = ref(false);

    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});

    let form: Ref<ITaxRule> = ref({
        id: null,
        name: null,
        percent: null
    });
    const formCopy: Ref<ITaxRule> = form;

    const list: Ref<ITaxRule[]> = ref([]);
    const allTaxRules: Ref<ITaxRule[]> = ref([]);
    const totalCount: Ref<number> = ref(0);

    const columns: tableColumn[] = [
        {
            name: 'name',
            required: true,
            label: 'Tax Rule name',
            align: 'left',
            field: row => row.name
        },
        {
            name: 'percent',
            required: true,
            label: 'Tax percent',
            align: 'left',
            field: row => row.percent
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
        return TaxRuleService.pagination(paginationData)
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
        return TaxRuleService.get(id)
        .then(res => res.data);
    }

    const save = (form: ITaxRule) => {

        addOrEdit(form)
        .then(res => {
            if (res.success) {
                notify.success('Shipping method saved');
                reset();
                router.push({name: 'shippings'});
            }
        })
    }

    const addOrEdit = (formData: ITaxRule) => {
        return isEdit.value ? TaxRuleService.update(formData, id.value as number) : TaxRuleService.add(formData);
    }

    const remove = (id: number|string|null) => {
        return TaxRuleService.remove(id as number)
        .then(res => {
            if (res.success) {
                notify.success("Tax rule removed!");
            } else {
                notify.error("Error on removing tax rule")
            }
        });
    }

    const getAllTaxRules = () => {
        return TaxRuleService.all()
        .then(res => {
            if (res.success) {
                allTaxRules.value = res.data;
            } else {
                notify.error('Error on getting tax rule list');
            }
        })
    }

    const taxRuleOptions = ref([...allTaxRules.value]);
    function filterTaxRules(val, update) {
        if (!val) {
            update(() => {
                taxRuleOptions.value = allTaxRules.value
            })
            return
        }

        update(() => {
            const needle = val.toLowerCase()
            taxRuleOptions.value = allTaxRules.value.filter(v => (v.name as string).toLowerCase().indexOf(needle) > -1)
        })
    }

    function displaySelectedTaxRule(id) {
        const taxRule = allTaxRules.value.find(b => b.id == id);
        return taxRule ? taxRule.name : 'None'
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
        getAllTaxRules,
        displaySelectedTaxRule,
        filterTaxRules,
        // ==========
        form,
        id,
        isEdit,
        columns,
        list,
        allTaxRules,
        taxRuleOptions
    }
}
