<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                    class="h-20 w-20 rounded-full object-cover">
                </h2>
            </div>
            <div class="container">
                <div class="flex">
                    <div class="capitalize w-25 mt-10">
                        Hello {{ $page.props.user.username }}
                    </div>
                </div>
            </div>
        </template>
    </pages-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import PagesLayout from '@/Layouts/PagesLayout.vue'

    export default defineComponent({
        components: {
            PagesLayout,

        },
    })
</script>
