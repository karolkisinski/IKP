<template>
    <admin-page>
        <div class="lg:px-10">
            <div>
                <slot name="title"></slot>
            </div>
            <div class="mt-5">
                <slot></slot>
            </div>
        </div>
    </admin-page>
</template>

<script>
import AppLayout from './AppLayout'
export default {
    components: {
        AppLayout,
    }


}
</script>
