import type { UnwrapNestedRefs } from 'vue';
import type { IPaginationParams } from '~/contracts/common/http/IApiData';
import type { ICart, ICartDb, ICartForm } from '~/contracts/pages/ICart';
import CartService from '~/services/api/cart-service';
import notify from '~/services/notify';

export const useCart = () => {
    let paginationData: UnwrapNestedRefs<IPaginationParams<null>> = reactive({page: 1, per_page: 10, sortBy: 'desc', descending: false});
    let form: UnwrapNestedRefs<ICart> = reactive({
        id: null,
        user_id: null,
        productId: null,
        image: null,
        productName: null,
        price: null,
        qty: null,
        total: null
    });
    const formCopy: UnwrapNestedRefs<ICart> = form;

    const list: Ref<ICart[]> = ref([]);
    const totalCount: Ref<number> = ref(0);
    function addToCart(productId: number, qty: number = 1) {

        const form: ICartForm = {product_id: productId, qty};

        CartService.add(form)
        .then(res => {
            if (res.success) {
                notify.success('Product added to cart!')
            } else {
                notify.error('Error on adding');
            }
        })
    }

    function getList() {
        CartService.pagination(paginationData)
        .then(res => {
            if (res.success) {
                list.value = res.data.data;
                totalCount.value = res.data.count;
                console.log('cart items', list.value)
            } else {
                notify.error('Error')
            }
        })
    }

    function adoptCartList(cartItems: ICartDb[]) {
// TODO: cart itemni cart sahifasida chiqarish. Backdan barcha kerakli ma'lumotlar oldindi
// Forntda ham barcha interfacelar to'g'rilandi. Faqat backdan kelgan ICartDb[] ma'lumotni
// frontdagi ICart[] ga moslab, sahifada chiqarish qoldi
    }

    return {
        addToCart,
        getList,
        // properties
        list,
    }
}
