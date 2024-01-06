<template>
    <!-- TopBar -->
    <CommonLayoutTopBar />

    <!-- NavBar -->
    <CommonLayoutNavBar />

    <slot />


    <!-- Footer -->
    <CommonLayoutFooter />

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <Notifications position="bottom right" classes="app-notification" width="320px" />
</template>
