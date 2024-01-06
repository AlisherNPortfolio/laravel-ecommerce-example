<template>
    <q-layout view="lHh Lpr lFf" class="bg-white">
      <app-header @open="handleDrawer($event)" :drawer-open="leftDrawerOpen"></app-header>

      <q-drawer
        v-model="leftDrawerOpen"
        show-if-above
        bordered
        class="bg-grey-2"
        :width="240"
      >
        <q-toolbar class="text-primary">
            <q-avatar>
                <img src="/storage/banners/user.png">
            </q-avatar>
            <q-toolbar-title>
                Multishop
            </q-toolbar-title>
        </q-toolbar>
        <app-menu :menu-list="menuList">
          <!-- <app-little-menu :menu-list="littleMenu"></app-little-menu>
          <app-little-menu :menu-list="rules" :second-type="true"></app-little-menu> -->
        </app-menu>
      </q-drawer>

      <q-page-container>
        <router-view />
      </q-page-container>
    </q-layout>
</template>

<script setup lang="ts">
  import { ref } from "vue";

  import AppMenu from "./components/AppMenu.vue";
  import AppHeader from "./components/AppHeader.vue";
  import { Menu } from "../contracts/IMenu";

  const leftDrawerOpen = ref(false);
  function handleDrawer(e) {
    leftDrawerOpen.value = !leftDrawerOpen.value;
  }

  const menuList: Menu[] = [
    { icon: "home", text: "Home", link: '/panel' },
    { icon: "people", text: "Users", link: '/panel/users' },
    { icon: "house", text: "Site content", children: [
        {
            icon: 'house', text: 'Banners', link: '/panel/banners'
        }
    ] },
    { icon: "storefront", text: "Catalog", children: [
        {
            icon: 'shopping_bag', text: 'Products', link: '/panel/products'
        },
        {
            icon: 'category', text: 'Categories', link: '/panel/categories'
        },
        {
            icon: 'local_offer', text: 'Attributes', link: '/panel/attributes'
        },
        {
            icon: 'stars', text: 'Brands', link: '/panel/brands'
        },
        {
            icon: 'request_quote', text: 'Tax rules', link: '/panel/tax-rules'
        },
    ] },
    { icon: "payment", text: "Payment", children: [
        {
            icon: 'card_membership', text: 'Payment type', link: '/panel/payment-types'
        }
    ] },
  ];


</script>

  <style lang="scss">
  .YL {
    &__toolbar-input-container {
      min-width: 100px;
      width: 55%;
    }
    &__toolbar-input-btn {
      border-radius: 0;
      border-style: solid;
      border-width: 1px 1px 1px 0;
      border-color: rgba(0, 0, 0, 0.24);
      max-width: 60px;
      width: 100%;
    }
    &__drawer-footer-link {
      color: inherit;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.75rem;
      &:hover {
        color: #000;
      }
    }
  }
  </style>
