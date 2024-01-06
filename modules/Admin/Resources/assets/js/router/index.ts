import TokenService from '../services/TokenService';
import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/panel',
    component: () => import('../layouts/AppMain.vue'),
    children: [
        {
            path: 'auth',
            component: () => import('../layouts/AppAuth.vue'),
            children: [
                {
                    path: 'login',
                    name: 'login',
                    component: () => import('../views/auth/AppLogin.vue')
                },
                {
                    path: 'register',
                    name: 'register',
                    component: () => import('../views/auth/AppRegister.vue')
                }
            ]
        },
        {
            path: '',
            component: () => import('../layouts/AppDashboard.vue'),
            children: [
                {
                    path: '',
                    name: 'dashboard',
                    component: () => import('../views/dashboard/dashboard.vue')
                },
                {
                    path: 'banners',
                    component: () => import('../views/banners/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'banners',
                            component: () => import('../views/banners/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'banners-add',
                            component: () => import('../views/banners/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'banners-edit',
                            component: () => import('../views/banners/create.vue')
                        }
                    ]
                },
                {
                    path: 'products',
                    component: () => import('../views/catalog/products/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'products',
                            component: () => import('../views/catalog/products/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'product-add',
                            component: () => import('../views/catalog/products/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'product-edit',
                            component: () => import('../views/catalog/products/create.vue')
                        }
                    ]
                },
                {
                    path: 'categories',
                    component: () => import('../views/catalog/categories/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'categories',
                            component: () => import('../views/catalog/categories/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'category-add',
                            component: () => import('../views/catalog/categories/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'category-edit',
                            component: () => import('../views/catalog/categories/create.vue')
                        }
                    ]
                },
                {
                    path: 'shippings',
                    component: () => import('../views/catalog/shipping/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'shippings',
                            component: () => import('../views/catalog/shipping/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'shipping-add',
                            component: () => import('../views/catalog/shipping/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'shipping-edit',
                            component: () => import('../views/catalog/shipping/create.vue')
                        }
                    ]
                },
                {
                    path: 'tax-rules',
                    component: () => import('../views/catalog/tax-rules/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'tax-rules',
                            component: () => import('../views/catalog/tax-rules/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'tax-rule-add',
                            component: () => import('../views/catalog/tax-rules/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'tax-rule-edit',
                            component: () => import('../views/catalog/tax-rules/create.vue')
                        }
                    ]
                },
                {
                    path: 'attributes',
                    component: () => import('../views/catalog/attributes/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'attributes',
                            component: () => import('../views/catalog/attributes/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'attribute-add',
                            component: () => import('../views/catalog/attributes/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'attribute-edit',
                            component: () => import('../views/catalog/attributes/create.vue')
                        }
                    ]
                },
                {
                    path: 'brands',
                    component: () => import('../views/catalog/brands/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'brands',
                            component: () => import('../views/catalog/brands/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'brand-add',
                            component: () => import('../views/catalog/brands/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'brand-edit',
                            component: () => import('../views/catalog/brands/create.vue')
                        }
                    ]
                },
                {
                    path: 'payment-types',
                    component: () => import('../views/payment/payment-types/index.vue'),
                    children: [
                        {
                            path: '',
                            name: 'payment-types',
                            component: () => import('../views/payment/payment-types/list.vue')
                        },
                        {
                            path: 'add',
                            name: 'payment-type-add',
                            component: () => import('../views/payment/payment-types/create.vue')
                        },
                        {
                            path: 'edit/:id',
                            name: 'payment-type-edit',
                            component: () => import('../views/payment/payment-types/create.vue')
                        }
                    ]
                },
            ]
          },
    ]
  },
  {
    path: "/:pathMatch(.*)*",
    name: "NotFound",
    component: () => import('../components/pages/Common/NotFoundPage.vue'),
    meta: {
      requiresAuth: false
    }
  }
]

const router = createRouter({
  history: createWebHistory(''),
  routes
});

router.beforeEach((to, from, next) => {
  const token: string|null = TokenService.getToken();
  if (token) {
    if (to.path === '/panel/auth/login' || to.path === '/panel/auth/register') {
      next('/panel');
    } else {
      next();
    }
  } else {
    if (to.path === '/panel') {
      next('/panel/auth/login');
    } else {
      next();
    }
  }
})

export default router
